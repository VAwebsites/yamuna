<?php

namespace App\Http\Controllers\Api;

use App\Models\ApprovedBank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ApprovedBankResource;
use App\Http\Resources\ApprovedBankCollection;
use App\Http\Requests\ApprovedBankStoreRequest;
use App\Http\Requests\ApprovedBankUpdateRequest;

class ApprovedBankController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', ApprovedBank::class);

        $search = $request->get('search', '');

        $approvedBanks = ApprovedBank::search($search)
            ->latest()
            ->paginate();

        return new ApprovedBankCollection($approvedBanks);
    }

    /**
     * @param \App\Http\Requests\ApprovedBankStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApprovedBankStoreRequest $request)
    {
        $this->authorize('create', ApprovedBank::class);

        $validated = $request->validated();
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('public');
        }

        $approvedBank = ApprovedBank::create($validated);

        return new ApprovedBankResource($approvedBank);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApprovedBank $approvedBank
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ApprovedBank $approvedBank)
    {
        $this->authorize('view', $approvedBank);

        return new ApprovedBankResource($approvedBank);
    }

    /**
     * @param \App\Http\Requests\ApprovedBankUpdateRequest $request
     * @param \App\Models\ApprovedBank $approvedBank
     * @return \Illuminate\Http\Response
     */
    public function update(
        ApprovedBankUpdateRequest $request,
        ApprovedBank $approvedBank
    ) {
        $this->authorize('update', $approvedBank);

        $validated = $request->validated();

        if ($request->hasFile('logo')) {
            if ($approvedBank->logo) {
                Storage::delete($approvedBank->logo);
            }

            $validated['logo'] = $request->file('logo')->store('public');
        }

        $approvedBank->update($validated);

        return new ApprovedBankResource($approvedBank);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApprovedBank $approvedBank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ApprovedBank $approvedBank)
    {
        $this->authorize('delete', $approvedBank);

        if ($approvedBank->logo) {
            Storage::delete($approvedBank->logo);
        }

        $approvedBank->delete();

        return response()->noContent();
    }
}
