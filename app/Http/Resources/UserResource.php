<?php

namespace App\Http\Resources;

use App\User;
use App\Course;
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
            'f_name' => $this->f_name,
            'l_name' => $this->l_name,
            'm_name' => $this->m_name,
            'user_id' => $this->user_id,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'dob' => $this->dob,
            'email' => $this->email,
            'r_address' => $this->r_address,
            'alternative_phone' => $this->alternative_phone,
            'username' => $this->username,
            'passport_path' => $this->passport_path,
            'Date_Joined' => Carbon::parse($this->created_at)->toDayDateTimeString(),
            'Guardian' => $this->guardians,
        ];
    }
}
