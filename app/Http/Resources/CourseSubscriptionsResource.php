<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseSubscriptionsResource extends JsonResource
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
            'title' => ucfirst($this->title),
            'duration' => $this->duration,
            'subject' => $this->subject->name,
            'thumbnail_path' => $this->thumbnail_path,
            'sypnosis' => $this->sypnosis,
            'published' => $this->published ? 'Published' : 'Unpublished',
            'path' => $this->path,
            'status' => $this->findSubscription(auth()->user())->status(),
            'subscribedOn' => Carbon::parse($this->findSubscription(auth()->user())->created_at)->toDayDateTimeString(),
            'subscribtionEndAt' => Carbon::parse($this->findSubscription(auth()->user())->created_at->addWeeks($this->duration))->toDayDateTimeString(),
        ];
    }
}
