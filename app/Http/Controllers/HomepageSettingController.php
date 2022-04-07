<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomepageSetting;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\HomepageSettingStoreRequest;
use App\Http\Requests\HomepageSettingUpdateRequest;

class HomepageSettingController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', HomepageSetting::class);

        $search = $request->get('search', '');

        $homepageSettings = HomepageSetting::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.homepage_settings.index',
            compact('homepageSettings', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', HomepageSetting::class);

        return view('app.homepage_settings.create');
    }

    /**
     * @param \App\Http\Requests\HomepageSettingStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(HomepageSettingStoreRequest $request)
    {
        $this->authorize('create', HomepageSetting::class);

        $validated = $request->validated();
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('public');
        }

        if ($request->hasFile('brochure')) {
            $validated['brochure'] = $request
                ->file('brochure')
                ->store('public');
        }

        $homepageSetting = HomepageSetting::create($validated);

        return redirect()
            ->route('homepage-settings.edit', $homepageSetting)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HomepageSetting $homepageSetting
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, HomepageSetting $homepageSetting)
    {
        $this->authorize('view', $homepageSetting);

        return view('app.homepage_settings.show', compact('homepageSetting'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HomepageSetting $homepageSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, HomepageSetting $homepageSetting)
    {
        $this->authorize('update', $homepageSetting);

        return view('app.homepage_settings.edit', compact('homepageSetting'));
    }

    /**
     * @param \App\Http\Requests\HomepageSettingUpdateRequest $request
     * @param \App\Models\HomepageSetting $homepageSetting
     * @return \Illuminate\Http\Response
     */
    public function update(
        HomepageSettingUpdateRequest $request,
        HomepageSetting $homepageSetting
    ) {
        $this->authorize('update', $homepageSetting);

        $validated = $request->validated();
        if ($request->hasFile('logo')) {
            if ($homepageSetting->logo) {
                Storage::delete($homepageSetting->logo);
            }

            $validated['logo'] = $request->file('logo')->store('public');
        }

        if ($request->hasFile('brochure')) {
            if ($homepageSetting->brochure) {
                Storage::delete($homepageSetting->brochure);
            }

            $validated['brochure'] = $request
                ->file('brochure')
                ->store('public');
        }

        $homepageSetting->update($validated);

        return redirect()
            ->route('homepage-settings.edit', $homepageSetting)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HomepageSetting $homepageSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, HomepageSetting $homepageSetting)
    {
        $this->authorize('delete', $homepageSetting);

        if ($homepageSetting->logo) {
            Storage::delete($homepageSetting->logo);
        }

        if ($homepageSetting->brochure) {
            Storage::delete($homepageSetting->brochure);
        }

        $homepageSetting->delete();

        return redirect()
            ->route('homepage-settings.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
