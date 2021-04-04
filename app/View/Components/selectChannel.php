<?php

namespace App\View\Components;

use App\Models\Channel;
use Illuminate\View\Component;

class selectChannel extends Component
{
    public $channels;
    public function __construct()
    {
        $this->channels = Channel::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select-channel');
    }
}
