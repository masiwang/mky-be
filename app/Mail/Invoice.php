<?php

namespace App\Mail;

use App\Models\User;
use App\Models\FundCheckout as Portofolio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Invoice extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $portofolio;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Portofolio $portofolio)
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
        ->view('template.email.invoice')
        ->with([
          'user_name' => $this->user->name,
          'product_name' => $this->portofolio->product->name,
          'vendor_name' => $this->portofolio->product->vendor->name,
          'invoice_code' => $this->portofolio->invoice,
          'qty' => $this->portofolio->qty,
          'price' => $this->portofolio->product->price,
          'estimated_return' => $this->portofolio->product->estimated_return,
          'created_at' => $this->portofolio->created_at,
          'ended_at' => $this->portofolio->product->ended_at
        ]);
    }
}
