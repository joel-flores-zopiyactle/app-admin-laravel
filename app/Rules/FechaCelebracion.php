<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FechaCelebracion implements Rule
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
        //echo $value;
        //echo '<br/>';
        $dateActual = date('Ymd'); // Obtenemosla fecha actual
        //echo $dateActual;
        $timestampSeleccionado = strtotime($value); // Convertimos la fecha seleccionado por el usuario a timestamp

        if(date('Ymd', $timestampSeleccionado) < $dateActual) { // Verificamos que no sea una fecha pasada
            return false;
        }
        

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No puede usar una fecha pasada para agendar una audiencia.';
        
    }
}
