<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\HomepageBanner;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\HomepageBannerResource;
use App\Http\Resources\HomepageBannerCollection;
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
            ->paginate();

        return new HomepageBannerCollection($homepageBanners);
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

        return new HomepageBannerResource($homepageBanner);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HomepageBanner $homepageBanner
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, HomepageBanner $homepageBanner)
    {
        $this->authorize('view', $homepageBanner);

        return new HomepageBannerResource($homepageBanner);
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

        return new HomepageBannerResource($homepageBanner);
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

        return response()->noContent();
    }
}
