<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CourseResource;

class CourseMaterialResource extends JsonResource {
    
    public function toArray(Request $request): array {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'path' => $this->path,
            'course' => new CourseResource($this->whenLoaded('course')),
        ];

    }

}
