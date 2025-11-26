<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseCategoryResource extends JsonResource {
    
    public function toArray(Request $request): array {

        return [
            'id' => $this->id,
            'createdAt' => $this->created_at,
            'name' => $this->name,
            'active' => (bool) $this->active,
        ];

    }

}
