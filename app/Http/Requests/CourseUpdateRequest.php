<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;

class CourseUpdateRequest extends FormRequest {

    protected $stopOnFirstFailure = true;
    
    public function rules(): array {

        return [
            'name' => ['nullable', 'string'],
            'course_category_id' => ['nullable', 'uuid', Rule::exists('course_categories', 'id')->where(function(Builder $query) {
                
                return $query->where('deleted_at', '=', null);
            
            }),],
            'price' => ['nullable', 'numeric', 'decimal:2', 'min:0',],
            'places' => ['nullable', 'integer', 'min:0',],
            'registration_start' => ['nullable', Rule::date()->format('Y-m-d H:i:s'),],
            'registration_end' => ['nullable', Rule::date()->format('Y-m-d H:i:s'),],
            'description' => ['nullable', 'string',],
            'thumbnail' => ['nullable', 'file', 'image', 'max:5120',],
            'active' => ['nullable', 'boolean',],
        ];

    }

    public function messages(): array {

        return [
            'name.string' => 'O nome escolhido para o curso deve ser um texto.',
            'course_category_id.uuid' => 'O ID da categoria escolhida para o curso é inválido.',
            'course_category_id.exists' => 'A categoria escolhida para o curso não existe ou não está ativada.',
            'price.numeric' => 'O preço do curso deve ser numérico.',
            'price.decimal' => 'O preço do curso deve ter 2 digitos decimais.',
            'price.min' => 'O preço do curso não deve ser menor que R$ 0,00.',
            'places.integer' => 'A quantidade de vagas disponíveis para o curso deve ser um número inteiro.',
            'places.min' => 'A quantidade de vagas disponíveis para o curso deve ser maior ou igual à :min.',
            'registration_start.date_format' => 'A data para início de inscrições para o curso é inválida.',
            'registration_end.date_format' => 'A data limite para inscrições no curso é inválida.',
            'description.string' => 'A descrição do curso deve ser um texto.',
            'thumbnail.file' => 'A moldura especificada para o curso é inválida.',
            'thumbnail.image' => 'A moldura especificada para o curso deve ser um arquivo de imagem.',
            'thumbnail.max' => 'A moldura do curso não deve possuir mais que 5MB.',
            'active.boolean' => 'O status do curso é inválido.',
        ];

    }

    public function failedValidation(Validator $validator): void {

        throw new HttpException(422, $validator->errors()->first());

    }

}
