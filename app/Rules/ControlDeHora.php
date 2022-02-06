<?php

namespace App\Rules;

use DateTime;
use DateTimeZone;
use Illuminate\Contracts\Validation\Rule;

class ControlDeHora implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    private $horaInicio;


    public function __construct($horaInicio)
    {
        $this->horaInicio = $horaInicio;
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
       
        $horaFormateadaFinalizar = preg_replace('/[\:]+/', '', $value);  // ejemplo 0000 
        $horaFormateadaInicio = preg_replace('/[\:]+/', '', $this->horaInicio);  // ejemplo 0000 

        //Hora Inicio
        $horaMeridianoInicio = new DateTime($this->horaInicio); 
        $meridianoInicio = $horaMeridianoInicio->format('A'); // nos dice si es AM o PM

        // Hora finalizar
        $horaMeridianoFinalizar = new DateTime($value); 
        $meridianoFinalizar = $horaMeridianoFinalizar->format('A'); // nos dice si es AM o PM

       
        if($meridianoInicio === $meridianoFinalizar) { //si am === am
            if($value < $this->horaInicio) { // si hora finalizar es menor a inicio return false
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La hora de finalización no puede ser menor a la hora de inicio.';
    }
}
