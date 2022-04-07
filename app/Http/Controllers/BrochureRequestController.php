<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrochureRequest;
use App\Http\Requests\BrochureRequestStoreRequest;
use App\Http\Requests\BrochureRequestUpdateRequest;

class BrochureRequestController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', BrochureRequest::class);

        $search = $request->get('search', '');

        $brochureRequests = BrochureRequest::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.brochure_requests.index',
            compact('brochureRequests', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', BrochureRequest::class);

        return view('app.brochure_requests.create');
    }

    /**
     * @param \App\Http\Requests\BrochureRequestStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrochureRequestStoreRequest $request)
    {
        $this->authorize('create', BrochureRequest::class);

        $validated = $request->validated();

        $brochureRequest = BrochureRequest::create($validated);

        return redirect()
            ->route('brochure-requests.edit', $brochureRequest)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BrochureRequest $brochureRequest
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BrochureRequest $brochureRequest)
    {
        $this->authorize('view', $brochureRequest);

        return view('app.brochure_requests.show', compact('brochureRequest'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BrochureRequest $brochureRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, BrochureRequest $brochureRequest)
    {
        $this->authorize('update', $brochureRequest);

        return view('app.brochure_requests.edit', compact('brochureRequest'));
    }

    /**
     * @param \App\Http\Requests\BrochureRequestUpdateRequest $request
     * @param \App\Models\BrochureRequest $brochureRequest
     * @return \Illuminate\Http\Response
     */
    public function update(
        BrochureRequestUpdateRequest $request,
        BrochureRequest $brochureRequest
    ) {
        $this->authorize('update', $brochureRequest);

        $validated = $request->validated();

        $brochureRequest->update($validated);

        return redirect()
            ->route('brochure-requests.edit', $brochureRequest)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BrochureRequest $brochureRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BrochureRequest $brochureRequest)
    {
        $this->authorize('delete', $brochureRequest);

        $brochureRequest->delete();

        return redirect()
            ->route('brochure-requests.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
