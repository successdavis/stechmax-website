<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'id'          => $this->id,
            'name'          => $this->user->f_name . ' ' . $this->user->l_name,
            'user_id'          => $this->user->user_id,
            'paygrade'      => $this->paygrade->name,
            'basic'         => number_format($this->paygrade->basic,2),
            'balance'       => $this->earningBalance(),
            'date_employed' => $this->employment_date->toDateString(),
            'years' =>      $this->employment_date->diffForHumans(),
        ];
    }
}
