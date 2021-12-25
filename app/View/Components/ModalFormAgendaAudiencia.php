<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ModalFormAgendaAudiencia extends Component
{
    public $expediente;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($expediente)
    {
        $this->expediente = $expediente;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal-form-agenda-audiencia');
    }
}
