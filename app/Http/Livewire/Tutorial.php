<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Tutorial extends Component
{
    public function render()
    {
        return view('livewire.tutorial')->layout('livewire._layout', ['title' => 'Tutorial']);
    }
}
