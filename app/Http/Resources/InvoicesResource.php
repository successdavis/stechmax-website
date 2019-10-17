<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoicesResource extends JsonResource
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
            'amount' => $this->amount / 100,
            'amountOwed' => $this->amountOwed() / 100,
            'payments' => UserPaymentsResource::collection($this->payments),
            'invoiceNo' => $this->invoiceNo,
            'billable' => $this->billable,
            'status' => $this->status(),
            'billedTo' => $this->owner,
        ];
    }
}
