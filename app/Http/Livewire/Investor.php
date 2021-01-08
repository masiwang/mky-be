<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Investor extends Component
{
  public $cari;
    public function render()
    {
      $user = User::where('name', 'like', '%'.$this->cari.'%')->get();
        return view('livewire.investor', compact('user'))->layout('livewire.admin._layout');
    }
}
