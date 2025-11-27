<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\CourseResource;
use App\Utils\PaymentUtil;

class EnrollmentResource extends JsonResource {
    
    public function toArray(Request $request): array {

        return [
            'id' => $this->id,
            'user' => new UserResource($this->whenLoaded('user')),
            'course' => new CourseResource($this->whenLoaded('course')),
            'status' => PaymentUtil::friendlyStatus($this->status),
            'method' => $this->method,
            'transaction_amount' => PaymentUtil::formatTransactionAmount($this->currency, $this->transaction_amount),
            'pix_qr_code' => $this->pix_qr_code,
            'pix_qr_code_base64' => $this->pix_qr_code_base64,
            'pix_expiration' => $this->pix_expiration,
        ];
    
    }

}
