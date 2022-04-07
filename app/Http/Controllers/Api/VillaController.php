<?php

namespace App\Http\Controllers\Api;

use App\Models\Villa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\VillaResource;
use App\Http\Resources\VillaCollection;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\VillaStoreRequest;
use App\Http\Requests\VillaUpdateRequest;

class VillaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $this->authorize('view-any', Villa::class);

        $search = $request->get('search', '');

        $villas = Villa::search($search)
            ->latest()
            ->paginate();

        return new VillaCollection($villas);
    }

    /**
     * @param \App\Http\Requests\VillaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(VillaStoreRequest $request)
    {
        $this->authorize('create', Villa::class);

        $validated = $request->validated();
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('public');
        }

        $villa = Villa::create($validated);

        return new VillaResource($villa);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Villa $villa
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Villa $villa)
    {
        $this->authorize('view', $villa);

        return new VillaResource($villa);
    }

    /**
     * @param \App\Http\Requests\VillaUpdateRequest $request
     * @param \App\Models\Villa $villa
     * @return \Illuminate\Http\Response
     */
    public function update(VillaUpdateRequest $request, Villa $villa)
    {
        $this->authorize('update', $villa);

        $validated = $request->validated();

        if ($request->hasFile('thumbnail')) {
            if ($villa->thumbnail) {
                Storage::delete($villa->thumbnail);
            }

            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('public');
        }

        $villa->update($validated);

        return new VillaResource($villa);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Villa $villa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Villa $villa)
    {
        $this->authorize('delete', $villa);

        if ($villa->thumbnail) {
            Storage::delete($villa->thumbnail);
        }

        $villa->delete();

        return response()->noContent();
    }
}
