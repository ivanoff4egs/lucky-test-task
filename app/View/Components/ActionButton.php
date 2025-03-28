<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionButton extends Component
{
    public string $route;
    public string $title;

    public function __construct(string $route, string $title)
    {
        $this->route = $route;
        $this->title = $title;
    }

    public function render(): View|Closure|string
    {
        return view('components.action-button');
    }
}
