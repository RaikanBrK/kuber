<?php

namespace App\View\Components\kuber;

use Kuber\Datatables\ServicesDatatables;

class Datatables extends ServicesDatatables
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.kuber.datatables');
    }
}
