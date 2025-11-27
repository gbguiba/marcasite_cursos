<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CourseMaterialUpdateRequest extends FormRequest {
    
    protected $stopOnFirstFailure = true;
    
    public function rules(): array {

        return [
            'name' => ['nullable', 'string',],
            'description' => ['nullable', 'string',],
            'path' => ['nullable', 'file', 'max:5120',],
            'course_id' => ['nullable', 'uuid', Rule::exists('courses', 'id')->where(function(Builder $query) {

                return $query->where('deleted_at', '=', null);

            }),],
        ];

    }

    public function messages(): array {

        return [
            'name.string' => 'O nome do material deve ser um texto.',
            'description.string' => 'A descrição do material deve ser um texto.',
            'path.file' => 'O arquivo do material é inválido.',
            'path.max' => 'O arquivo do material deve ter, no máximo, 5MB.',
            'course_id.uuid' => 'O ID do curso deve ser um UUID.',
            'course_id.exists' => 'O curso especificado não existe.',
        ];

    }

    public function failedValidation(Validator $validator): void {

        throw new HttpException(422, $validator->errors()->first());

    }

}
