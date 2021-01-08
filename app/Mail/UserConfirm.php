<?php

namespace App\Mail;

use App\Models\User as UserDB;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserConfirm extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserDB $user)
    {
      $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->user->email)
        ->subject('Akun Anda telah dikonfirmasi')
        ->view('template.email.user-confirm')
        ->with([
          'user_name' => $this->user->name
        ]);
    }
}
