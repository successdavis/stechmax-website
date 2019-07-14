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
            'f_name' => $this->f_name,
            'l_name' => $this->l_name,
            'gender' => $this->gender,
            'phone' => $this->phone,
            // 'avatar_path' => $this->avatar_path,
            // 'created_at' => Carbon::parse($this->created_at)->toDayDateTimeString(),
        ];
    }
}
