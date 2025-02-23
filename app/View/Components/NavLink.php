<?php
namespace App\View\Components;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class NavLink extends Component
{
    public $route;

    public function __construct($route)
    {
        $this->route = $route;
    }

    public function isActive()
    {
        return (Request::is(trim($this->route, '/') . '*') || Route::currentRouteName() == $this->route)
        ? 'active fw-bold'
        : '';
    }

    public function render()
    {
        return view('components.nav-link');
    }
}