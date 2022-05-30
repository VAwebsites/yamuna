<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\HomepageBannerResource;
use App\Http\Resources\ApprovedBankResource;

class HomepageSettingResource extends JsonResource
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
      "project_title" => $this->project_title,
      "project_location" => $this->project_location,
      "rera_number" => $this->rera_number,
      "youtube_link" => $this->youtube_link,
      "youtube_link_2" => $this->youtube_link_2,
      "youtube_link_3" => $this->youtube_link_3,
      "brochure" =>  $this->brochure ? asset(\Storage::url($this->brochure)) : '',
      "project_overview" => html_entity_decode($this->project_overview),
      "project_type" => html_entity_decode($this->project_type),
      "project_status" => html_entity_decode($this->project_status),
      "address_line_1" => html_entity_decode($this->address_line_1),
      "address_line_2" => html_entity_decode($this->address_line_2),
      "contact_number" => html_entity_decode($this->contact_number),
      "email" => $this->email,
      "footer_description" => html_entity_decode($this->footer_description),
      "logo" =>  $this->logo ? asset(\Storage::url($this->logo)) : '',
      'banners' => HomepageBannerResource::collection($this->homepageBanners), 
      'approved_banks' => ApprovedBankResource::collection($this->approvedBanks), 
        ];
    }
}
