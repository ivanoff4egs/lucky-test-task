<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionButton extends Component
{
    public string $route;
    public string $title;
    public string $method;

    public function __construct(string $route, string $title, string|null $method = 'POST')
    {
        $this->route = $route;
        $this->title = $title;
        $this->method = $method;
    }

    public function render(): View|Closure|string
    {
        return view('components.action-button');
    }
}
