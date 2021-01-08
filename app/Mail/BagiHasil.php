<?php

namespace App\Mail;

use App\Models\User;
use App\Models\FundCheckout as Portofolio;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BagiHasil extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $portofolio;
    public $transaction;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Portofolio $portofolio, Transaction $transaction)
    {
      $this->user = $user;
      $this->portofolio = $portofolio;
      $this->transaction = $transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->to($this->user->email)
        ->subject('Bagi Hasil #'.$this->portofolio->invoice)
        ->view('template.email.bagi-hasil')
        ->with([
          'user_name' => $this->user->name,
          'product_name' => $this->portofolio->product->name,
          'vendor_name' => $this->portofolio->product->vendor->name,
          'transaction_code' => $this->transaction->code,
          'invoice_code' => $this->portofolio->invoice,
          'qty' => $this->portofolio->qty,
          'price' => $this->portofolio->product->price,
          'actual_return' => $this->portofolio->product->actual_return,
          'created_at' => $this->portofolio->created_at,
          'ended_at' => $this->portofolio->product->ended_at
        ]);
    }
}
