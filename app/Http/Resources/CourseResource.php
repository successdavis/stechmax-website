<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            // 'id' => $this->id,
            'title' => $this->title,
            'duration' => $this->duration,
            // 'subject_id' => $this->subject_id,
            // 'sypnosis' => $this->sypnosis,
            'published' => $this->published,
        ];
    }
}
