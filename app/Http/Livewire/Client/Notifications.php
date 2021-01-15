<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;
use App\Models\Notification as NotificationDB;
use Auth;

class Notifications extends Component
{
  public $notif;
  public $search;
  public $status = 'all';
  public $order_by = 'id';
  public $order_to = 'desc';
  public $page = 1;
  public $detail_view;

  public function view($id){
    $notif = NotificationDB::find($id);
    if($notif->status == 'unread'){
      $notif->update([
        'status' => 'read'
      ]);
    }
    $this->notif = $notif;
  }

  public function detailView($id){
    $notif = NotificationDB::find($id);
    if($notif->status == 'unread'){
      $notif->update([
        'status' => 'read'
      ]);
    }
    $this->notif = $notif;
    $this->detail_view = true;
  }

  public function more(){
    $this->page++;
  }

  public function render(){
    $notifications = NotificationDB::where('user_id', Auth::id());
    if($this->search){
      $notifications = $notifications->where('title', 'like', '%'.$this->search.'%')
        ->where('body', 'like', '%'.$this->search.'%');
    }
    if(!($this->status == 'all')){
      $notifications = $notifications->where('status', $this->status);
    }
    $notifications = $notifications->orderBy($this->order_by, $this->order_to)
      ->limit($this->page * 10)->get();
    $title = 'Notifikasi';
    return view('livewire.client.notifications', compact('notifications'))->layout('livewire._layout', ['title' => 'Notifikasi']);
  }
}
