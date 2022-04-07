<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\HomepageSetting;
use App\Http\Controllers\Controller;
use App\Http\Resources\HomepageBannerResource;
use App\Http\Resources\HomepageBannerCollection;

class HomepageSettingHomepageBannersController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HomepageSetting $homepageSetting
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, HomepageSetting $homepageSetting)
    {
        // $this->authorize('view', $homepageSetting);

        $search = $request->get('search', '');

        $homepageBanners = $homepageSetting
            ->homepageBanners()
            ->search($search)
            ->latest()
            ->paginate();

        return new HomepageBannerCollection($homepageBanners);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HomepageSetting $homepageSetting
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, HomepageSetting $homepageSetting)
    {
        // $this->authorize('create', HomepageBanner::class);

        $validated = $request->validate([
            'banner' => ['required'],
        ]);

        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->store('public');
        }

        $homepageBanner = $homepageSetting
            ->homepageBanners()
            ->create($validated);

        return new HomepageBannerResource($homepageBanner);
    }
}
