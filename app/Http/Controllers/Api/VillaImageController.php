<?php

namespace App\Http\Controllers\Api;

use App\Models\VillaImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\VillaImageResource;
use App\Http\Resources\VillaImageCollection;
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
            ->paginate();

        return new VillaImageCollection($villaImages);
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

        return new VillaImageResource($villaImage);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\VillaImage $villaImage
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, VillaImage $villaImage)
    {
        $this->authorize('view', $villaImage);

        return new VillaImageResource($villaImage);
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

        return new VillaImageResource($villaImage);
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

        return response()->noContent();
    }
}
