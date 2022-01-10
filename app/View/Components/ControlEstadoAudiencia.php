<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ControlEstadoAudiencia extends Component
{
    public $estadoAudiencia;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($estadoAudiencia)
    {
        $this->estadoAudiencia = $estadoAudiencia;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.control-estado-audiencia');
    }
}
