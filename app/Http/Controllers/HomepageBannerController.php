<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomepageBanner;
use App\Models\HomepageSetting;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\HomepageBannerStoreRequest;
use App\Http\Requests\HomepageBannerUpdateRequest;

class HomepageBannerController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', HomepageBanner::class);

        $search = $request->get('search', '');

        $homepageBanners = HomepageBanner::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.homepage_banners.index',
            compact('homepageBanners', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', HomepageBanner::class);

        $homepageSettings = HomepageSetting::pluck('project_title', 'id');

        return view('app.homepage_banners.create', compact('homepageSettings'));
    }

    /**
     * @param \App\Http\Requests\HomepageBannerStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(HomepageBannerStoreRequest $request)
    {
        $this->authorize('create', HomepageBanner::class);

        $validated = $request->validated();
        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->store('public');
        }

        $homepageBanner = HomepageBanner::create($validated);

        return redirect()
            ->route('homepage-banners.edit', $homepageBanner)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HomepageBanner $homepageBanner
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, HomepageBanner $homepageBanner)
    {
        $this->authorize('view', $homepageBanner);

        return view('app.homepage_banners.show', compact('homepageBanner'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HomepageBanner $homepageBanner
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, HomepageBanner $homepageBanner)
    {
        $this->authorize('update', $homepageBanner);

        $homepageSettings = HomepageSetting::pluck('project_title', 'id');

        return view(
            'app.homepage_banners.edit',
            compact('homepageBanner', 'homepageSettings')
        );
    }

    /**
     * @param \App\Http\Requests\HomepageBannerUpdateRequest $request
     * @param \App\Models\HomepageBanner $homepageBanner
     * @return \Illuminate\Http\Response
     */
    public function update(
        HomepageBannerUpdateRequest $request,
        HomepageBanner $homepageBanner
    ) {
        $this->authorize('update', $homepageBanner);

        $validated = $request->validated();
        if ($request->hasFile('banner')) {
            if ($homepageBanner->banner) {
                Storage::delete($homepageBanner->banner);
            }

            $validated['banner'] = $request->file('banner')->store('public');
        }

        $homepageBanner->update($validated);

        return redirect()
            ->route('homepage-banners.edit', $homepageBanner)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HomepageBanner $homepageBanner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, HomepageBanner $homepageBanner)
    {
        $this->authorize('delete', $homepageBanner);

        if ($homepageBanner->banner) {
            Storage::delete($homepageBanner->banner);
        }

        $homepageBanner->delete();

        return redirect()
            ->route('homepage-banners.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
