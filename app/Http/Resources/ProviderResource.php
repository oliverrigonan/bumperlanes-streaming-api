<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProviderResource extends JsonResource
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
            'provider_number' => $this->provider_number,
            'npi' => $this->npi,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'extension_name' => $this->extension_name,
            'qualifications' => $this->qualifications,
            'gender' => $this->gender,
            'main_phone' => $this->main_phone,
            'direct_dial' => $this->direct_dial,
            'fax' => $this->fax,
            'email' => $this->email,
            'web_url' => $this->web_url,
            'facility_id' => $this->facility_id,
            'facility' => new FacilityResource($this->whenLoaded('facility')),
            'profession' => $this->profession,
            'speciality1' => $this->speciality1,
            'speciality2' => $this->speciality2,
            'title1' => $this->title1,
            'title2' => $this->title2,
            'title3' => $this->title3,
            'title4' => $this->title4,
            'title5' => $this->title5,
            'status' => $this->status,
            'date_last_modified' => $this->date_last_modified,
            'modified_by' => $this->modified_by,
            'image_url' => $this->image_url,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'city' => $this->city,
            'state' => $this->state
        ];
    }
}
