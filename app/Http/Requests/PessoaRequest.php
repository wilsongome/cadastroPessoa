<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PessoaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

   /*  public function messages(): array
    {
        return [
            'cpf' => 'CPF inválido!',
            'data_nascimento' => 'Data de nascimento inválida!',
            'email' => 'E-mail inválido!',
            'genero' => 'Gênero inválido!'
        ];
    } */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'cpf' => 'required|unique:cpf|max:255',
            'nome' => 'required|max:255',
            'sobrenome' => 'required|max:255',
            'data_nascimento' => 'required|date',
            'email' => 'required|max:255',
            'genero' => 'required|max:255'
        ];
    }
}
