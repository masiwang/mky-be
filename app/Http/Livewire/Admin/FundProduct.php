<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\FundProduct as ProductDB;
use App\Models\Notification as NotificationDB;
use App\Models\FundCheckout as PortofolioDB;
use App\Models\Transaction as TransactionDB;
use App\Models\User as UserDB;
use App\Models\Vendor as VendorDB;
use App\Mail\Invoice as InvoiceMail;
use App\Mail\BagiHasil as BagiHasilMail;
use Mail;
use Str;
use Image;
use Carbon\Carbon;

class FundProduct extends Component
{
  use WithPagination;
  use WithFileUploads;

  public $product;
  public $view = 'detail';
  public $product_name, $product_vendor_id, $product_category_id, $product_price, $product_total_stock, $product_current_stock, $product_estimated_return, $product_actual_return, $product_started_at, $product_ended_at, $product_prospectus, $product_description, $product_image, $product_image_url;
  public $page_investor = 1;
  public $new_investor_name, $new_investor_qty;

  public function mount($id){
    $this->product = ProductDB::find($id);
    $this->product_name = $this->product->name;
    $this->product_vendor_id = $this->product->vendor_id;
    $this->product_category_id = $this->product->category_id;
    $this->product_price = $this->product->price;
    $this->product_total_stock = $this->product->total_stock;
    $this->product_current_stock = $this->product->current_stock;
    $this->product_estimated_return = $this->product->estimated_return;
    $this->product_actual_return = $this->product->actual_return;
    $this->product_started_at = $this->product->started_at;
    $this->product_ended_at = $this->product->ended_at;
    $this->product_prospectus = $this->product->prospectus;
    $this->product_description = $this->product->description;
  }

  public function sendInvoice($id){
    $portofolio = PortofolioDB::find($id);
    $portofolio->invoice_sent_at = Carbon::now();
    $portofolio->invoice_sent_by = 1;
    $portofolio->save();
    // kirim notifikasi
    $notifikasi = NotificationDB::create([
      'user_id' => $portofolio->user_id,
      'title' => 'Invoice #'.$portofolio->invoice,
      'body' => 'Hi, '.$portofolio->user->name.' 👋.<br/><br/>Terima kasih kami ucapkan kepada Anda, dengan ini anda
      secara resmi berpartisipasi dalam Project Funding '.$portofolio->product->name.' oleh '.$portofolio->product->vendor->name.'. Berikut adalah <em>invoice</em> pendanaan Anda,<br/><br/>
      <table style="border: 1px solid black;border-collapse: collapse;width: 100%;">
      <tr><td style="border: 1px solid black;width: 30%;">Invoice No.</td><td style="border: 1px solid black;width: 70%;">'.$portofolio->invoice.'</td></tr>
      <tr><td style="border: 1px solid black">Produk pendanaan</td><td style="border: 1px solid black">'.$portofolio->product->name.'</td></tr>
      <tr><td style="border: 1px solid black">Jml. Pendanaan</td><td>'.$portofolio->qty.' paket</td style="border: 1px solid black"></tr>
      <tr><td style="border: 1px solid black">Harga paket</td><td style="border: 1px solid black">Rp '.number_format($portofolio->product->price, 0, ',', '.').'/paket</td></tr>
      <tr><td style="border: 1px solid black">Total Pendanaan</td><td style="border: 1px solid black">Rp '.number_format($portofolio->qty*$portofolio->product->price, 0, ',', '.').',-</td></tr>
      <tr><td style="border: 1px solid black">Estimasi ROI</td><td style="border: 1px solid black">'.$portofolio->product->estimated_return.'%</td></tr>
      <tr><td style="border: 1px solid black">Waktu Pendanaan</td><td style="border: 1px solid black">'.$portofolio->created_at.'</td></tr>
      <tr><td style="border: 1px solid black">Est. Waktu Selesai</td><td style="border: 1px solid black">'.$portofolio->product->ended_at.'</td></tr>
      </table><br/>
      Apabila terdapat kesalahan atau pertanyaan terkait notifikasi ini, harap hubungi Support Makarya melalui WA (+62) 821 3000 4204 atau melalui Email support@makarya.in<br/><br/>
      Salam 💚,<br/>Tim Makarya'
    ]);
    // kirim email
    $user = UserDB::find($portofolio->user_id);
    Mail::to($user)->send(new InvoiceMail($user, $portofolio));
    $this->portofolios = PortofolioDB::where('product_id', $this->product->id)->paginate(10);
  }

  public function sendReturn($id){
    $portofolio = PortofolioDB::find($id);
    // set return telah dikirim
    $portofolio->return_sent_at = Carbon::now();
    $portofolio->return_sent_by = 1;
    $portofolio->save();

    $user = UserDB::find($portofolio->user_id);
    // kirim transfer
    $trf_code = 'MKYTRFI'.$user->id.Carbon::now()->timestamp;
    $transfer = TransactionDB::create([
      'code' => $trf_code,
      'user_id' => $user->id,
      'type' => 'in',
      'bank_type' => 'MAKARYA',
      'bank_acc' => $user->id,
      'nominal' => $portofolio->product->price * $portofolio->qty * (1 + ($portofolio->product->actual_return/100)),
      'status_id' => 2,
      'approved_by' => 1,
      'approved_at' => Carbon::now(),
      'comment' => 'Bagi Hasil Pendanaan '.$portofolio->product->name
    ]);
    // kirim notifikasi
    $notifikasi = NotificationDB::create([
      'user_id' => $portofolio->user_id,
      'title' => 'Invoice #'.$portofolio->invoice,
      'body' => 'Hi, '.$portofolio->user->name.' 👋.<br/><br/>Terimakasih telah melakukan pendanaan pada Project Funding '.$portofolio->product->name.' oleh '.$portofolio->product->vendor->name.'. Pendanaan tersebut telah selesai. Return telah dikirim ke Akun Anda dengan kode transaksi '.$trf_code.'. Berikut ini adalah detail transaksi <em>return</em> pendanaan,<br/><br/>
      <table style="border: 1px solid black;border-collapse: collapse;width: 100%;">
      <tr><td style="border: 1px solid black;width: 30%;">Kode Pendanaan</td><td style="border: 1px solid black;width: 70%;">'.$portofolio->invoice.'</td></tr>
      <tr><td style="border: 1px solid black">Produk pendanaan</td><td style="border: 1px solid black">'.$portofolio->product->name.'</td></tr>
      <tr><td style="border: 1px solid black">Total Pendanaan</td><td style="border: 1px solid black">Rp '.number_format($portofolio->qty*$portofolio->product->price, 0, ',', '.').',-</td></tr>
      <tr><td style="border: 1px solid black">ROI (%)</td><td style="border: 1px solid black">'.$portofolio->product->actual_return.'%</td></tr>
      <tr><td style="border: 1px solid black">ROI (Rp.)</td><td style="border: 1px solid black">'.$portofolio->qty * $portofolio->product->price * ($portofolio->product->actual_return/100).'</td></tr>
      <tr><td style="border: 1px solid black">Total ditransfer</td><td style="border: 1px solid black">'.$portofolio->qty * $portofolio->product->price * (1+$portofolio->product->actual_return/100).'</td></tr>
      </table><br/>
      Apabila terdapat kesalahan atau pertanyaan terkait notifikasi ini, harap hubungi Support Makarya melalui WA (+62) 821 3000 4204 atau melalui Email support@makarya.in<br/><br/>
      Salam 💚,<br/>Tim Makarya'
    ]);
    // kirim email
    // echo compact('user', 'portofolio', 'transfer');
    Mail::to($user)->send(new BagiHasilMail($user, $portofolio, $transfer));
  }

  public function addNewInvestor(){
    $user = UserDB::where('name', $this->new_investor_name)->first();
    // menambah portofolio
    $portofolio = PortofolioDB::create([
      'invoice' => 'MKYINVF'.$user->id.Carbon::now(),
      'product_id' => $this->product->id,
      'user_id' => $user->id,
      'qty' => $this->new_investor_qty,
    ]);
    // mengurangi stock
    $product = ProductDB::find($this->product->id);
    $old_stock = $product->current_stock;
    $product->current_stock = $old_stock - $this->new_investor_qty;
    $product->save();
    // mengurangi saldo user
    $transaction = TransactionDB::create([
      'code' => 'MKYTRFO'.$user->id.Carbon::now(),
      'user_id' => $user->id,
      'type' => 'out',
      'bank_type' => 'MAKARYA',
      'bank_acc' => $user->id,
      'nominal' => $product->price * $this->new_investor_qty * (-1),
      'status_id' => 2,
      'approved_by' => 1,
      'approved_at' => Carbon::now(),
      'comment' => 'Funding '.$product->name
    ]);
  }

  public function uploadImage(){
    $random = Str::random(32);
    $image = Image::make($this->product_image)->fit(500)->save('assets/fund/'.$random.'.jpg');
    $this->product_image_url = '/assets/fund/'.$random.'.jpg';
  }

  public function update(){
    $product = ProductDB::find($this->product->id);

    $update_query = [
      'name' => $this->product_name,
      'vendor_id' => $this->product_vendor_id,
      'category_id' => $this->product_category_id,
      'price' => $this->product_price,
      'total_stock' => $this->product_total_stock,
      'current_stock' => $this->product_current_stock,
      'estimated_return' => $this->product_estimated_return,
      'actual_return' => $this->product_actual_return,
      'started_at' => $this->product_started_at,
      'ended_at' => $this->product_ended_at,
      'prospectus' => $this->product_prospectus,
      'description' => $this->product_description,
    ];

    if($this->product_image){
      $this->uploadImage();
      $update_query['image'] = $this->product_image_url;
    }
    $product = $product->update($update_query);
    $this->product = ProductDB::find($this->product->id);
  }

  public function moreInvestor(){
    $this->page_investor++;
  }
  
  public function render(){
    $vendors = VendorDB::get();
    $portofolios = PortofolioDB::where('product_id', $this->product->id)->limit($this->page_investor * 8 - 1)->get();
    $users = UserDB::limit(10);
    if($this->new_investor_name){
      $users = $users->where('name', 'like', '%'.$this->new_investor_name.'%')->orWhere('email', 'like', '%'.$this->new_investor_name.'%');
    }
    $users = $users->get();
    return view('livewire.admin.fund-product', compact('vendors', 'portofolios', 'users'))->layout('livewire.admin._layout');
  }
}
