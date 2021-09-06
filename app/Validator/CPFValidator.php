<?php


namespace App\Validator;


trait CPFValidator
{
    function validateCPF($number) : bool
    {
        // Elimina possivel máscara.
        // E verifica se o numero de digitos informados é igual a 11
        $cpf = preg_replace('/[^0-9]/', "", $number);

        if (strlen($cpf) != 11 || preg_match('/([0-9])\1{10}/', $cpf)) {
            return false;
        }

        // Verifica se nenhuma das sequências inválidas abaixo
        // foi digitada. Caso afirmativo, retorna falso.
        if ($cpf === '00000000000' ||
            $cpf === '11111111111' ||
            $cpf === '22222222222' ||
            $cpf === '33333333333' ||
            $cpf === '44444444444' ||
            $cpf === '55555555555' ||
            $cpf === '66666666666' ||
            $cpf === '77777777777' ||
            $cpf === '88888888888' ||
            $cpf === '99999999999') {

            return false;
        }

        // Calcula os dígitos verificadores para verificar se o CPF é válido.
        $number_quantity_to_loop = [9, 10];

        foreach ($number_quantity_to_loop as $item) {
            $sum = 0;
            $number_to_multiplicate = $item + 1;

            for ($index = 0; $index < $item; $index++) {

                $sum += $cpf[$index] * ($number_to_multiplicate--);
            }

            $result = (($sum * 10) % 11);

            if ($cpf[$item] != $result) {
                return false;
            }
        }

        return true;
    }
}
