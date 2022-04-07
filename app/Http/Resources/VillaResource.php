<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\VillaImageResource;

class VillaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'bhk' => $this->bhk,
            'sq_feet' => $this->sq_feet,
            'land_size' => $this->land_size,
            'price' => $this->price,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail ? asset(\Storage::url($this->thumbnail)) : '',
            'images' => VillaImageResource::collection($this->villaImages)  
        ];

    }
}
