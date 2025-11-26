<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;

class CourseStoreRequest extends FormRequest {

    protected $stopOnFirstFailure = true;
    
    public function rules(): array {

        return [
            'name' => ['required', 'string'],
            'course_category_id' => ['required', 'uuid', Rule::exists('course_categories', 'id')->where(function(Builder $query) {
                
                return $query->where('deleted_at', '=', null);
            
            }),],
            'price' => ['required', 'numeric', 'decimal:2', 'min:0',],
            'places' => ['required', 'integer', 'min:0',],
            'registration_start' => ['required', Rule::date()->format('Y-m-d H:i:s'),],
            'registration_end' => ['required', Rule::date()->format('Y-m-d H:i:s'),],
            'description' => ['required', 'string',],
            'thumbnail' => ['nullable', 'file', 'image', 'max:5120',],
            'active' => ['required', 'boolean',],
        ];

    }

    public function messages(): array {

        return [
            'name.required' => 'Escolha um nome para o curso.',
            'name.string' => 'O nome escolhido para o curso deve ser um texto.',
            'course_category_id.required' => 'Especifique a categoria do curso.',
            'course_category_id.uuid' => 'O ID da categoria escolhida para o curso é inválido.',
            'course_category_id.exists' => 'A categoria escolhida para o curso não existe ou não está ativada.',
            'price.required' => 'Especifique o preço do curso.',
            'price.numeric' => 'O preço do curso deve ser numérico.',
            'price.decimal' => 'O preço do curso deve ter 2 digitos decimais.',
            'price.min' => 'O preço do curso não deve ser menor que R$ 0,00.',
            'places.required' => 'Especifique a quantidade de vagas disponíveis para o curso.',
            'places.integer' => 'A quantidade de vagas disponíveis para o curso deve ser um número inteiro.',
            'places.min' => 'A quantidade de vagas disponíveis para o curso deve ser maior ou igual à :min.',
            'registration_start.required' => 'Especifique a data de início para inscrições no curso.',
            'registration_start.date_format' => 'A data para início de inscrições para o curso é inválida.',
            'registration_end.required' => 'Especifique a data limite para inscrições no curso.',
            'registration_end.date_format' => 'A data limite para inscrições no curso é inválida.',
            'description.required' => 'Forneça a descrição do curso.',
            'description.string' => 'A descrição do curso deve ser um texto.',
            'thumbnail.file' => 'A moldura especificada para o curso é inválida.',
            'thumbnail.image' => 'A moldura especificada para o curso deve ser um arquivo de imagem.',
            'thumbnail.max' => 'A moldura do curso não deve possuir mais que 5MB.',
            'active.required' => 'Especifique se o curso será criado já ativado ou desativado.',
            'active.boolean' => 'O status do curso é inválido.',
        ];

    }

    public function failedValidation(Validator $validator): void {

        throw new HttpException(422, $validator->errors()->first());

    }

}
