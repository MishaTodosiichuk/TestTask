<?php

namespace App\View\Components\album;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class jumbotron extends Component
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
        return view('components.album.jumbotron');
    }
}