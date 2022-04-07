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
      "brochure" =>  $this->brochure ? asset(\Storage::url($this->brochure)) : '',
      "project_overview" => $this->project_overview,
      "project_type" => $this->project_type,
      "project_status" => $this->project_status,
      "address_line_1" => $this->address_line_1,
      "address_line_2" => $this->address_line_2,
      "contact_number" => $this->contact_number,
      "footer_description" => $this->footer_description,
      "logo" =>  $this->logo ? asset(\Storage::url($this->logo)) : '',
      'banners' => HomepageBannerResource::collection($this->homepageBanners), 
      'approved_banks' => ApprovedBankResource::collection($this->approvedBanks), 
        ];
    }
}
