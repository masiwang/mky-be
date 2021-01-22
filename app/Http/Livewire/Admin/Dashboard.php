<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use OneSignal;

class Dashboard extends Component
{
  public function sendTestNotification(){

    $params = [];
    $params['included_segments'] = ['Test User'];
    $contents = [
      "en" => 'Test english',
      "id" => 'Test indo'
    ];
    $headings = [
      'en' => 'Judul english',
      'id' => 'Judul indo'
    ];
    $subtitle = [
      'en' => 'Subtitle enflish',
      'id' => 'Subtitle indo'
    ];
    $params['contents'] = $contents;
    $params['headings'] = $headings;
    $params['subtitle'] = $subtitle;
    $params['chrome_big_picture'] = 'https://makarya.in/assets/fund/g4UKrn4JdK73WrC48tD3R1wJB9ut5tyr.jpg';
    OneSignal::sendNotificationCustom($params);
    return session()->flash('success', true);


  }
    public function render()
    {
        return view('livewire.admin.dashboard')->layout('livewire.admin._layout');
    }
}
