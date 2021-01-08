<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User as UserDB;


class Users extends Component
{
  public $page_number = 1;
  public $select_by = 'verified';
  public $order_by = 'name';
  public $order_to = 'asc';
  public $query = '';

  public function more(){
    $this->page_number++;
  }

  public function select($param){
    $this->select_by = $param;
  }

  public function orderBy($param){
    $this->order_by = $param;
  }

  public function orderTo($param){
    $this->order_to = $param;
  }

  public function render(){
    $users = UserDB::orderBy($this->order_by, $this->order_to)->limit($this->page_number * 8);
    if($this->select_by == 'verified'){
      $users = $users->whereNotNull('ktp_verified_at');
    }
    if($this->select_by == 'new'){
      $users = $users->whereNull('ktp_verified_at');
    }
    if($this->query){
      $users = $users->where('name', 'like', '%'. $this->query.'$')
        ->orWhere('email', 'like', '%'.$this->query.'%');
    }
    $users = $users->get();
    return view('livewire.admin.users', compact('users'))->layout('livewire.admin._layout');
  }
}
