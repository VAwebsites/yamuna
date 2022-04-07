<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\HomepageSetting;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApprovedBankResource;
use App\Http\Resources\ApprovedBankCollection;

class HomepageSettingApprovedBanksController extends Controller
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

        $approvedBanks = $homepageSetting
            ->approvedBanks()
            ->search($search)
            ->latest()
            ->paginate();

        return new ApprovedBankCollection($approvedBanks);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HomepageSetting $homepageSetting
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, HomepageSetting $homepageSetting)
    {
        // $this->authorize('create', ApprovedBank::class);

        $validated = $request->validate([
            'logo' => ['required'],
            'name' => ['required', 'max:255', 'string'],
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('public');
        }

        $approvedBank = $homepageSetting->approvedBanks()->create($validated);

        return new ApprovedBankResource($approvedBank);
    }
}
