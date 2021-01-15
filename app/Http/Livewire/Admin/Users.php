<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User as UserDB;


class Users extends Component
{
  public $filter;
  public $page_number = 1;
  public $status = 'verified';
  public $order_by = 'name';
  public $order_to = 'asc';
  public $query = '';

  public function more(){
    $this->page_number++;
  }

  public function render(){
    $users = UserDB::orderBy($this->order_by, $this->order_to)->limit($this->page_number * 8);
    if($this->status == 'verified'){
      $users = $users->whereNotNull('ktp_verified_at');
    }
    if($this->status == 'new'){
      $users = $users->whereNull('ktp_verified_at');
    }
    if($this->query){
      $users = $users->where('name', 'like', '%'. $this->query.'%')
        ->orWhere('email', 'like', '%'.$this->query.'%');
    }
    $users = $users->get();
    return view('livewire.admin.users', compact('users'))->layout('livewire.admin._layout');
  }
}
