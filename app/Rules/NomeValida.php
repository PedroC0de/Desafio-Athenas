<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NomeValida implements Rule
{
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
        $eValido = true;
        $len = strlen($value);
        if($len < 3 or $len > 40){
            $eValido = false;
        }

        return $eValido;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(){
        return 'Por favor, digite um nome com mais de 3 caracteres e um nome com menos de 40 caracteres';
    }
}
