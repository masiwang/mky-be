<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoicePortofolio extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $portofolio;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = $user;
        $this->portofolio = $portofolio;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->user->email)
        ->subject('Invoice #'.$this->portofolio->invoice)
        ->view('template.email.invoice');
    }
}
