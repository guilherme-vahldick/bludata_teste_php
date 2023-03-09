<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidaCnpjRule implements Rule
{
    public function validarCNPJ($cnpj) {
        // Remover caracteres não numéricos
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        // Verificar o comprimento do CNPJ
        if (strlen($cnpj) != 14) {
            return false;
        }

        // Verificar se todos os dígitos são iguais
        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }

        // Calcular o primeiro dígito verificador
        $soma = 0;
        for ($i = 0; $i < 12; $i++) {
            $soma += (int) $cnpj[$i] * (($i < 4) ? 5 - $i : 13 - $i);
        }
        $digito1 = (($soma % 11) < 2) ? 0 : (11 - ($soma % 11));

        // Calcular o segundo dígito verificador
        $soma = 0;
        for ($i = 0; $i < 13; $i++) {
            $soma += (int) $cnpj[$i] * (($i < 5) ? 6 - $i : 14 - $i);
        }
        $digito2 = (($soma % 11) < 2) ? 0 : (11 - ($soma % 11));

        // Verificar se os dígitos calculados correspondem aos dígitos informados
        return ($cnpj[12] == $digito1 && $cnpj[13] == $digito2);
    }

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->validarCNPJ($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O CNPJ informado é invalido!';
    }
}
