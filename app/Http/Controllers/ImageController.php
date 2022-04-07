<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.images.index', compact('images', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Image::class);

        return view('app.images.create');
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

        return redirect()
            ->route('images.edit', $image)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Image $image
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Image $image)
    {
        $this->authorize('view', $image);

        return view('app.images.show', compact('image'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Image $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Image $image)
    {
        $this->authorize('update', $image);

        return view('app.images.edit', compact('image'));
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

        return redirect()
            ->route('images.edit', $image)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('images.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
