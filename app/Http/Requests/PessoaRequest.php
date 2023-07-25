<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class PessoaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
                'required'    => 'O campo :attribute é obrigatório.',
                'unique'    => 'O :attribute informado já existe no sistema.',
                'email'    => 'O campo :attribute é inválido.',
                'max'    => 'O campo :attribute deve ter no máximo :max caracteres.',
                'alpha'    => 'O campo :attribute deve ser texto.',
                'date'    => 'O campo :attribute é inválido.',
                'regex'    => 'O campo :attribute é inválido.'
        ];
    }

    public function after(): array
    {
        return [
            
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'cpf' => 'required|unique:pessoas|max:255',
            'nome' => 'required|max:15|regex:/^[A-Za-z]+$/',
            'sobrenome' => 'required|alpha|max:50',
            'email' => 'required|email|max:50',
            'data_nascimento' => 'required|date',
            'genero' => 'required|alpha|max:10',
        ];
    }
}
