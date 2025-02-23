<?php
namespace App\View\Components;

use Illuminate\View\Component;

class FrontLayout extends Component
{
    public $title;
    /**
     * Create a new component instance.
     */
    public function __construct($title = '')
    {
        $this->title = $title ?? config('app.name');

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('layouts.front-layout');
    }
}