<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NearByLocationResource extends JsonResource
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
            'name' => $this->name,
            'order' => $this->order,
            'distance' => $this->distance,
            'img' => $this->img ? asset(\Storage::url($this->img)) : '',
        ];
    }
}
