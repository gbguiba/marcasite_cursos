<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthLoginRequest extends FormRequest {

    protected $stopOnFirstFailure = true;
    
    public function rules(): array {
        
        return [
            'email' => ['required', 'string', 'email',],
            'password' => ['required', 'string',],
        ];
    
    }

    public function messages(): array {

        return [
            'email.required' => 'Forneça o e-mail.',
            'email.string' => 'O e-mail fornecido deve ser um texto.',
            'email.email' => 'O e-mail fornecido é inválido. Forneça um e-mail válido.',
            'password.required' => 'Forneça a senha.',
            'password.string' => 'A senha deve ser um texto.',
        ];

    }

    public function failedValidation(Validator $validator): void {

        throw new HttpException(422, $validator->errors()->first());

    }

}
