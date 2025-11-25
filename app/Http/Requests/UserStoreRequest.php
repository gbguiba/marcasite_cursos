<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\User;
use App\Models\Profile;

class UserStoreRequest extends FormRequest {

    protected $stopOnFirstFailure = true;

    public function rules(): array {

        return [
            'type' => ['required', 'bail', Rule::in(['user', 'admin']), 'bail',],
            'email' => ['required', 'bail', 'email:strict,rfc', 'bail', 'unique:' . User::class . ',email', 'bail',],
            'password' => ['required', 'bail', 'string', 'bail',],
            'passwordRepeat' => ['required', 'bail', 'same:password', 'bail',],
            'name' => ['required', 'bail', 'string', 'bail',],
            'photo' => ['nullable', 'bail', 'file', 'bail', 'max:5120', 'bail', 'mimetypes:image/png,image/gif,image/jpeg,image/webp', 'bail',],
            'cpf' => ['required', 'bail', 'numeric', 'bail', 'digits:11', 'bail', 'unique:' . Profile::class . ',cpf', 'bail',],
        ];
    
    }

    public function messages(): array {

        return [
            'type.required' => 'Forneça o tipo do usuário.',
            'type.in' => 'O tipo do usuário é inválido.',
            'email.required' => 'Insira o e-mail do usuário.',
            'email.email' => 'O e-mail inserido é inválido.',
            'email.unique' => 'O e-mail especificado já está sendo utilizado.',
            'password.required' => 'Escolha uma senha para o usuário.',
            'password.string' => 'A senha do usuário deve ser um texto.',
            'passwordRepeat.required' => 'Confirme a senha escolhida.',
            'passwordRepeat.same' => 'As senhas devem ser iguais.',
            'name.required' => 'Insira o nome do usuário.',
            'name.string' => 'O nome do usuário deve ser um texto.',
            'photo.file' => 'A foto do usuário deve ser uma imagem.',
            'photo.max' => 'A foto do usuário deve ter, no máximo, 5MB.',
            'photo.mimetypes' => 'A foto do usuário deve ser uma imagem do tipo PNG, GIF, JPEG ou WEBP.',
            'cpf.required' => 'Insira o CPF do usuário.',
            'cpf.numeric' => 'O CPF do usuário deve possuir somente números.',
            'cpf.digits' => 'O CPF do usuário deve possuir :digits digitos.',
            'cpf.unique' => 'O CPF especificado já está sendo utilizado.',
        ];

    }

    public function failedValidation(Validator $validator): void {

        throw new HttpException(422, $validator->errors()->first());

    }

}
