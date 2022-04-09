<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HomepageBannerResource extends JsonResource
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
            'banner' => $this->banner ? asset(\Storage::url($this->banner->orderBy('order', 'ASC'))) : '',
        ];
    }
}
