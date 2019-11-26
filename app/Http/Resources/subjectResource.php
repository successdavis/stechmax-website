<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class subjectResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'icon_path' => $this->icon_path,
            'coursesCount' => $this->getSubjectCourses()->count(),
            'tracksCount' => $this->getSubjectTracks()->count(),
        ];
    }
}
