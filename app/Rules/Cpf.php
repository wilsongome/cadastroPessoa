<?php

namespace App\Rules;

use App\Domain\Pessoa\Cpf as PessoaCpf;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Cpf implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cpf = new PessoaCpf($value);
        if($cpf == ''){
            $fail('O CPF informado é inválido!');
        }
    }
}
