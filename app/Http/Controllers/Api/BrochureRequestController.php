<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\BrochureRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrochureRequestResource;
use App\Http\Resources\BrochureRequestCollection;
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
            ->paginate();

        return new BrochureRequestCollection($brochureRequests);
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

        return new BrochureRequestResource($brochureRequest);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BrochureRequest $brochureRequest
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BrochureRequest $brochureRequest)
    {
        $this->authorize('view', $brochureRequest);

        return new BrochureRequestResource($brochureRequest);
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

        return new BrochureRequestResource($brochureRequest);
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

        return response()->noContent();
    }
}
