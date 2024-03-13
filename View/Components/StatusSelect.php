<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusSelect extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.status-select');
    }


    public function options()
    {
        return [
            'Crée',
            'En cours de livraison',
            'Livré',
            'Livré et payé',
            'Planification retour',
            'Retourné',
        ];
    }
}
