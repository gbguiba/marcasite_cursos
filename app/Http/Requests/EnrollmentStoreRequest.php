<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Contracts\Validation\Validator;

class EnrollmentStoreRequest extends FormRequest {
    
    protected $stopOnFirstFailure = true;

    public function rules(): array {

        return [
            'user_id' => ['required', 'uuid', Rule::exists('users', 'id')->where(function(Builder $query) {

                return $query->where('deleted_at', '=', null);

            }),],
            'course_id' => ['required', 'uuid', Rule::exists('courses', 'id')->where(function(Builder $query) {

                return $query->where('deleted_at', '=', null);

            })],
        ];
    
    }

    public function messages(): array {

        return [
            'user_id.required' => 'Especifique o usuário.',
            'user_id.uuid' => 'O ID do usuário deve ser um UUID válido.',
            'user_id.exists' => 'O usuário não existe ou não está ativado.',
            'course_id.required' => 'Especifique o curso.',
            'course_id.uuid' => 'O ID do curso deve ser um UUID válido.',
            'course_id.exists' => 'O curso não existe ou não está ativado.',
        ];

    }

    public function failedValidation(Validator $validator): void {

        throw new HttpException(422, $validator->errors()->first());

    }

}
