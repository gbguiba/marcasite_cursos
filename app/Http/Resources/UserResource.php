<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProfileResource;

class UserResource extends JsonResource {
    
    public function toArray(Request $request): array {

        return [
            'id' => $this->id,
            'type' => $this->type,
            'email' => $this->email,
            'active' => (bool) $this->active,
            'profile' => new ProfileResource($this->profile),
        ];
    
    }

}
