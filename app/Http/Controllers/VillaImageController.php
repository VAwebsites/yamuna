<?php

namespace App\Http\Controllers;

use App\Models\Villa;
use App\Models\VillaImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\VillaImageStoreRequest;
use App\Http\Requests\VillaImageUpdateRequest;

class VillaImageController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', VillaImage::class);

        $search = $request->get('search', '');

        $villaImages = VillaImage::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.villa_images.index', compact('villaImages', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', VillaImage::class);

        $villas = Villa::pluck('id', 'id');

        return view('app.villa_images.create', compact('villas'));
    }

    /**
     * @param \App\Http\Requests\VillaImageStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(VillaImageStoreRequest $request)
    {
        $this->authorize('create', VillaImage::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $villaImage = VillaImage::create($validated);

        return redirect()
            ->route('villa-images.edit', $villaImage)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\VillaImage $villaImage
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, VillaImage $villaImage)
    {
        $this->authorize('view', $villaImage);

        return view('app.villa_images.show', compact('villaImage'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\VillaImage $villaImage
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, VillaImage $villaImage)
    {
        $this->authorize('update', $villaImage);

        $villas = Villa::pluck('id', 'id');

        return view('app.villa_images.edit', compact('villaImage', 'villas'));
    }

    /**
     * @param \App\Http\Requests\VillaImageUpdateRequest $request
     * @param \App\Models\VillaImage $villaImage
     * @return \Illuminate\Http\Response
     */
    public function update(
        VillaImageUpdateRequest $request,
        VillaImage $villaImage
    ) {
        $this->authorize('update', $villaImage);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($villaImage->image) {
                Storage::delete($villaImage->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $villaImage->update($validated);

        return redirect()
            ->route('villa-images.edit', $villaImage)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\VillaImage $villaImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, VillaImage $villaImage)
    {
        $this->authorize('delete', $villaImage);

        if ($villaImage->image) {
            Storage::delete($villaImage->image);
        }

        $villaImage->delete();

        return redirect()
            ->route('villa-images.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
