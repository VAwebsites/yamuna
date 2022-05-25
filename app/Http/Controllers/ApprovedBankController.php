<?php

namespace App\Http\Controllers;

use App\Models\ApprovedBank;
use Illuminate\Http\Request;
use App\Models\HomepageSetting;
use Illuminate\Support\Facades\Storage;
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
            ->orderBy('order','ASC')
            ->withQueryString();

        return view(
            'app.approved_banks.index',
            compact('approvedBanks', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', ApprovedBank::class);

        $homepageSettings = HomepageSetting::pluck('project_title', 'id');

        return view('app.approved_banks.create', compact('homepageSettings'));
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

        return redirect()
            ->route('approved-banks.edit', $approvedBank)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApprovedBank $approvedBank
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ApprovedBank $approvedBank)
    {
        $this->authorize('view', $approvedBank);

        return view('app.approved_banks.show', compact('approvedBank'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApprovedBank $approvedBank
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ApprovedBank $approvedBank)
    {
        $this->authorize('update', $approvedBank);

        $homepageSettings = HomepageSetting::pluck('project_title', 'id');

        return view(
            'app.approved_banks.edit',
            compact('approvedBank', 'homepageSettings')
        );
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

        return redirect()
            ->route('approved-banks.edit', $approvedBank)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('approved-banks.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
