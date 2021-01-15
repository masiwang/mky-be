<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class IDCard extends Mailable
{
    use Queueable, SerializesModels;
    public $user, $path;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $path)
    {
      $this->user = $user;
      $this->path = $path;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to('maulanaichwana@gmail.com')
        ->subject('ID User')
        ->view('template.email.id-card')
        ->with([
          'user_id' => $this->user->id,
          'user_name' => $this->user->name
        ])
        ->attach(Storage::disk('public')->url($this->path));
    }
}
