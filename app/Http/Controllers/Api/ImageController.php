<?php

namespace App\Http\Controllers\Api;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ImageResource;
use App\Http\Resources\ImageCollection;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ImageStoreRequest;
use App\Http\Requests\ImageUpdateRequest;

class ImageController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Image::class);

        $search = $request->get('search', '');

        $images = Image::search($search)
            ->latest()
            ->paginate();

        return new ImageCollection($images);
    }

    /**
     * @param \App\Http\Requests\ImageStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImageStoreRequest $request)
    {
        $this->authorize('create', Image::class);

        $validated = $request->validated();
        if ($request->hasFile('img_path')) {
            $validated['img_path'] = $request
                ->file('img_path')
                ->store('public');
        }

        $image = Image::create($validated);

        return new ImageResource($image);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Image $image
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Image $image)
    {
        $this->authorize('view', $image);

        return new ImageResource($image);
    }

    /**
     * @param \App\Http\Requests\ImageUpdateRequest $request
     * @param \App\Models\Image $image
     * @return \Illuminate\Http\Response
     */
    public function update(ImageUpdateRequest $request, Image $image)
    {
        $this->authorize('update', $image);

        $validated = $request->validated();

        if ($request->hasFile('img_path')) {
            if ($image->img_path) {
                Storage::delete($image->img_path);
            }

            $validated['img_path'] = $request
                ->file('img_path')
                ->store('public');
        }

        $image->update($validated);

        return new ImageResource($image);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Image $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Image $image)
    {
        $this->authorize('delete', $image);

        if ($image->img_path) {
            Storage::delete($image->img_path);
        }

        $image->delete();

        return response()->noContent();
    }
}
