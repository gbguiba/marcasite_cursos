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
            'type' => ['required', Rule::in(['user', 'admin']),],
            'email' => ['required', 'email:strict,rfc', 'unique:' . User::class . ',email',],
            'password' => ['required', 'string',],
            'password_repeat' => ['required', 'same:password',],
            'name' => ['required', 'string',],
            'photo' => ['nullable', 'file', 'max:5120', 'image',],
            'cpf' => ['required', 'numeric', 'digits:11', 'unique:' . Profile::class . ',cpf',],
            'active' => ['required', 'boolean',],
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
            'password_repeat.required' => 'Confirme a senha escolhida.',
            'password_repeat.same' => 'As senhas devem ser iguais.',
            'name.required' => 'Insira o nome do usuário.',
            'name.string' => 'O nome do usuário deve ser um texto.',
            'photo.file' => 'A foto do usuário deve ser uma imagem.',
            'photo.max' => 'A foto do usuário deve ter, no máximo, 5MB.',
            'photo.image' => 'A foto do usuário deve ser um arquivo de imagem.',
            'cpf.required' => 'Insira o CPF do usuário.',
            'cpf.numeric' => 'O CPF do usuário deve possuir somente números.',
            'cpf.digits' => 'O CPF do usuário deve possuir :digits digitos.',
            'cpf.unique' => 'O CPF especificado já está sendo utilizado.',
            'active.required' => 'Especifique se o usuário será criado já ativado ou desativado.',
            'active.boolean' => 'O status do usuário é inválido.',
        ];

    }

    public function failedValidation(Validator $validator): void {

        throw new HttpException(422, $validator->errors()->first());

    }

}
