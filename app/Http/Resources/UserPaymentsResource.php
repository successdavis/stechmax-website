<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserPaymentsResource extends JsonResource
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
            'date' => Carbon::parse($this->created_at)->toDayDateTimeString(),
            'amount' => str_replace('-', '', ($this->amount / 100)),
            'status' => 'success',
            'method' => $this->method,
            'purpose' => $this->purpose,
            'ref' => $this->transaction_ref,
        ];
    }
}
