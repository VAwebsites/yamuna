<?php

namespace App\Http\Controllers\Api;

use App\Models\Villa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\VillaImageResource;
use App\Http\Resources\VillaImageCollection;

class VillaVillaImagesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Villa $villa
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Villa $villa)
    {
        $this->authorize('view', $villa);

        $search = $request->get('search', '');

        $villaImages = $villa
            ->villaImages()
            ->search($search)
            ->latest()
            ->paginate();

        return new VillaImageCollection($villaImages);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Villa $villa
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Villa $villa)
    {
        $this->authorize('create', VillaImage::class);

        $validated = $request->validate([
            'image' => ['image', 'max:1024'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $villaImage = $villa->villaImages()->create($validated);

        return new VillaImageResource($villaImage);
    }
}
