<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CourseCategoryResource;

class CourseResource extends JsonResource {
    
    public function toArray(Request $request): array {

        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'name' => $this->name,
            'courseCategory' => new CourseCategoryResource($this->courseCategory),
            'price' => $this->price,
            'places' => $this->places,
            'registrationStart' => $this->registration_start,
            'registrationEnd' => $this->registration_end,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail,
            'active' => (bool) $this->active,
        ];

    }

}
