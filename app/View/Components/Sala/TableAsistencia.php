<?php

namespace App\View\Components\Sala;

use Illuminate\View\Component;

class TableAsistencia extends Component
{
    public $participantes;
    public $audienciaid;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($participantes,  $audienciaid)
    {
        $this->participantes = $participantes;
        $this->audienciaid = $audienciaid;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sala.table-asistencia');
    }
}
