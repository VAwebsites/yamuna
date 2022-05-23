<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NearByLocation;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\NearByLocationStoreRequest;
use App\Http\Requests\NearByLocationUpdateRequest;

class NearByLocationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', NearByLocation::class);

        $search = $request->get('search', '');

        $nearByLocations = NearByLocation::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.near_by_locations.index',
            compact('nearByLocations', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', NearByLocation::class);

        return view('app.near_by_locations.create');
    }

    /**
     * @param \App\Http\Requests\NearByLocationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(NearByLocationStoreRequest $request)
    {
        $this->authorize('create', NearByLocation::class);

        $validated = $request->validated();
        if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('public');
        }

        $nearByLocation = NearByLocation::create($validated);

        return redirect()
            ->route('near-by-locations.edit', $nearByLocation)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\NearByLocation $nearByLocation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, NearByLocation $nearByLocation)
    {
        $this->authorize('view', $nearByLocation);

        return view('app.near_by_locations.show', compact('nearByLocation'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\NearByLocation $nearByLocation
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, NearByLocation $nearByLocation)
    {
        $this->authorize('update', $nearByLocation);

        return view('app.near_by_locations.edit', compact('nearByLocation'));
    }

    /**
     * @param \App\Http\Requests\NearByLocationUpdateRequest $request
     * @param \App\Models\NearByLocation $nearByLocation
     * @return \Illuminate\Http\Response
     */
    public function update(
        NearByLocationUpdateRequest $request,
        NearByLocation $nearByLocation
    ) {
        $this->authorize('update', $nearByLocation);

        $validated = $request->validated();
        if ($request->hasFile('img')) {
            if ($nearByLocation->img) {
                Storage::delete($nearByLocation->img);
            }

            $validated['img'] = $request->file('img')->store('public');
        }

        $nearByLocation->update($validated);

        return redirect()
            ->route('near-by-locations.edit', $nearByLocation)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\NearByLocation $nearByLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, NearByLocation $nearByLocation)
    {
        $this->authorize('delete', $nearByLocation);

        if ($nearByLocation->img) {
            Storage::delete($nearByLocation->img);
        }

        $nearByLocation->delete();

        return redirect()
            ->route('near-by-locations.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
