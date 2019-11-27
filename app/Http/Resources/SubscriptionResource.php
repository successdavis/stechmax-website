<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
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
            'status' => $this->status(),
            'subscribedOn' => Carbon::parse($this->created_at)->toDayDateTimeString(),
            'subscribtionEndAt' => Carbon::parse($this->created_at->addWeeks($this->duration))->toDayDateTimeString(),
            'class' => $this->isSubscribeToClass(),
            'course' => $this->subscriber,
        ];
    }
}
