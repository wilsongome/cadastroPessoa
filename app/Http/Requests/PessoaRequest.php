<?php

namespace App\Http\Requests;

use App\Rules\Cpf;
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
                'regex'    => 'O campo :attribute é inválido.',
                'before_or_equal' => "O campo :attribute não pode estar no futuro."
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
            'cpf' => ['required','unique:pessoas,cpf,'. $this->route('id'),'max:255', new Cpf()],
            'nome' => 'required|max:15|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\']+$/',
            'sobrenome' => 'required|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\'\s]+$/|max:50',
            'email' => 'required|email|max:50',
            'data_nascimento' => 'required|date_format:d/m/Y|before_or_equal:today',
            'genero' => 'required|alpha|max:10',
        ];
    }
}
