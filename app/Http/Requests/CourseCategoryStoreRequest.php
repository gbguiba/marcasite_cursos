<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CourseCategoryStoreRequest extends FormRequest {
    
    protected $stopOnFirstFailure = true;

    public function rules(): array {
        
        return [
            'name' => ['required', 'string',],
            'active' => ['required', 'boolean',],
        ];
    
    }

    public function messages(): array {

        return [
            'name.required' => 'Escolha um nome para a categoria.',
            'name.string' => 'O nome escolhido deve ser um texto.',
            'active.required' => 'Especifique se a categoria será criada já ativada ou desativada.',
            'active.boolean' => 'O status da categoria é inválido.',
        ];

    }

    public function failedValidation(Validator $validator): void {

        throw new HttpException(422, $validator->errors()->first());

    }

}
