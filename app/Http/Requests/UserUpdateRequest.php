<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\User;
use App\Models\Profile;

class UserUpdateRequest extends FormRequest {

    protected $stopOnFirstFailure = true;

    public function rules(): array {

        return [
            'type' => ['nullable', Rule::in(['user', 'admin']),],
            'email' => ['nullable', 'email:strict,rfc', Rule::unique('users', 'email')->ignore($this->user->id),],
            'password' => ['nullable', 'string',],
            'password_repeat' => ['required_with:password', 'same:password',],
            'name' => ['nullable', 'string',],
            'photo' => ['nullable', 'file', 'max:5120', 'image',],
            'cpf' => ['nullable', 'numeric', 'digits:11', Rule::unique('profiles', 'cpf')->ignore($this->user->profile->id),],
            'active' => ['nullable', 'boolean',],
        ];
    
    }

    public function messages(): array {

        return [
            'type.in' => 'O tipo do usuário é inválido.',
            'email.email' => 'O e-mail inserido é inválido.',
            'email.unique' => 'O e-mail especificado já está sendo utilizado.',
            'password.string' => 'A senha do usuário deve ser um texto.',
            'password_repeat.required_with' => 'Confirme a senha escolhida.',
            'password_repeat.same' => 'As senhas devem ser iguais.',
            'name.string' => 'O nome do usuário deve ser um texto.',
            'photo.file' => 'A foto do usuário deve ser uma imagem.',
            'photo.max' => 'A foto do usuário deve ter, no máximo, 5MB.',
            'photo.image' => 'A foto do usuário deve ser um arquivo de imagem.',
            'cpf.numeric' => 'O CPF do usuário deve possuir somente números.',
            'cpf.digits' => 'O CPF do usuário deve possuir :digits digitos.',
            'cpf.unique' => 'O CPF especificado já está sendo utilizado.',
            'active.boolean' => 'O status do usuário é inválido.',
        ];

    }

    public function failedValidation(Validator $validator): void {

        throw new HttpException(422, $validator->errors()->first());

    }

}
