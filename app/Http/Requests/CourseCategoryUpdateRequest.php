<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CourseCategoryUpdateRequest extends FormRequest {
    
    protected $stopOnFirstFailure = true;

    public function rules(): array {
        
        return [
            'name' => ['nullable', 'string',],
            'active' => ['nullable', 'boolean',],
        ];
    
    }

    public function messages(): array {

        return [
            'name.string' => 'O nome escolhido deve ser um texto.',
            'active.boolean' => 'O status da categoria é inválido.',
        ];

    }

    public function failedValidation(Validator $validator): void {

        throw new HttpException(422, $validator->errors()->first());

    }

}
