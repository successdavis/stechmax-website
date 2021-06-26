<?php

namespace App\Http\Resources;

use App\Course;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResourceSearch extends JsonResource
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
            'name'              => ucwords($this->f_name . ' ' . $this->m_name . ' ' . $this->l_name),
            'f_name'            => $this->f_name,
            'l_name'            => $this->l_name,
            'm_name'            => $this->m_name,
            'user_id'           => $this->user_id,
            'username'          => $this->username,
        ];
    }
}
