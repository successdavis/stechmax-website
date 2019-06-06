<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'f_name' => $this->f_name,
            'l_name' => $this->l_name,
            'm_name' => $this->m_name,
            'phone' => $this->phone,
            'r_address' => $this->r_address,
            'gender' => $this->gender,
            'dob'    => $this->dob,
            'avatar_path' => $this->avatar_path,
            'created_at' => Carbon::parse($this->created_at)->toDayDateTimeString(),
        ];
    }
}