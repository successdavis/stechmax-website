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
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'duration' => $this->duration,
            'subject' => $this->subject->name,
            'thumbnail_path' => $this->thumbnail_path,
            'sypnosis' => $this->sypnosis,
            'duration' => $this->duration,
            'published' => $this->published ? 'Published' : 'Unpublished',
            'path' => $this->path,
            'type' => $this->type->name,
//            'difficulty' => $this->difficulty->level,
            'amount' => $this->getAmount(),

        ];
    }
}
