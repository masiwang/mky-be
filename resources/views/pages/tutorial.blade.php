@extends('components.__master')
@section('title') Tutorial @endsection
@section('content')
@include('components._top_navigation')
<div class="container mt-3 mb-5 bg-white p-4">
  <div class="row mt-4">
    <div class="col-12">
      <div>
        <h2>Daftar isi</h2>
        <ol>
          <li><a href="#registrasi" class="text-decoration-none">Cara registrasi</a></li>
          <li><a href="#topup" class="text-decoration-none">Cara isi saldo</a></li>
          <li><a href="#funding" class="text-decoration-none">Cara pendanaan</a></li>
          <li><a href="#withdraw" class="text-decoration-none">Cara tarik saldo</a></li>
        </ol>
      </div>
      <div class="mb-4" id="registrasi">
        <h2>Cara registrasi</h2>
        <p>Sebelum registrasi, investor diminta menyiapkan foto Kartu Tanda Penduduk (KTP) serta foto tanda tangan sesuai KTP pada kertas putih. Investor makarya dapat melakukan registrasi akun makarya pada halaman berikut <a href="https://makarya.in/register">https://makarya.in/register</a>.</p>
        <p>Proses registrasi akun makarya terdiri dari 5 tahapan sebagai berikut,</p>
        <ol>
          <li>
            <p>Investor makarya memasukkan alamat email aktif beserta password baru untuk akun makarya pada halaman <a href="https://makarya.in/register">https://makarya.in/register</a></p>
          </li>
          <li>
            <p>Investor makarya selanjutnya diarahkan ke halaman getting-started bagian pertama, yaitu konfirmasi alamat email. Konfirmasi alamat email dapat dilakukan dengan memasukkan kode atau token verifikasi email yang telah dikirimkan ke email terdaftar.</p>
          </li>
          <li>
            <p>Langkah selanjutnya, investor diminta untuk mengisikan data diri sesuai KTP berupa nama lengkap, tanggal lahir, jenis kelamin, nomor <em>handphone</em> aktif (WhatsApp lebih dianjurkan) dan pekerjaan saat ini.</p>
          </li>
          <li>
            <p>
              Selanjutnya investor diminta untuk mengisikan data alamat investor sesuai KTP.
            </p>
          </li>
          <li>
            <p>Langkah selanjutnya, investor diminta untuk mengisi kolom ID KTP dan mengunggah foto KTP.</p>
          </li>
          <li>
            <p>Langkah terakhir, investor diminta untuk membaca syarat dan ketentuan investasi makarya. Setelah setuju, investor wajib mencentang <em>checklist</em> pernyataan setuju dan mengunggah foto tanda tangan.</p>
          </li>
        </ol>
        <p>Investor yang melakukan registrasi namun data tidak sesuai dengan KTP maka tidak dapat dikonfirmasi, sehingga tidak dapat melakukan pendanaan.</p>
        <p>Notifikasi konfirmasi akun investor makarya dikirim melalui email dan atau menu notifikasi website makarya paling lama dalam 1x24 jam. Apabila investor belum menerima konfirmasi, investor dapat menghubungi pihak makarya melalui WhatsApp ataupun Email.</p>
      </div>
      <div class="mb-4" id="topup">
        <h2>Cara isi saldo</h2>
        <p>Investor makarya hanya bisa melakukan pengisian saldo apabila akun telah terkonfirmasi oleh pihak makarya.</p>
        
        <p>Adapun cara konfirmasi pengisian saldo makarya adalah sebagai berikut,</p>
        <ol>
          <li>
            <p>Pengisian saldo makarya dilakukan dengan transfer melalui bank/ATM/m-banking/e-money ke rekening BNI Syariah 1060317498 a.n. PT. Inspira Karya Teknologi Nusantara</p>
          </li>
          <li>
            <p>Investor diminta untuk mengunjungi halaman website <a href="https://makarya.in/transaction/topup">https://makarya.in/transaction/topup</a></p>
          </li>
          <li>
            <p>Selanjutnya, investor diminta untuk mengisi form berupa nama bank, nomor rekening, jumlah transfer dan foto bukti transfer.</p>
          </li>
        </ol>
        <p>Dalam maksimal 1x24 jam, pihak makarya akan mengkonfirmasi bukti transfer investor. Apabila terkonfirmasi, investor dapat melakukan pendanaan menggunakan saldo makarya.</p>
      </div>
      <div class="mb-4" id="funding">
        <h2>Cara pendanaan</h2>
        <p>Pendanaan hanya dapat dilakukan oleh investor dengan akun yang telah terkonfirmasi dan memiliki saldo lebih dari harga paket produk pendanaan. Apabila investor memiliki saldo kurang dari harga paket produk pendanaan, maka investor diminta melakukan pengisian saldo makarya terlebih dahulu.</p>
        <p>Berikut ini adalah cara melakukan pendanaan makarya,</p>
        <ol>
          <li>
            <p>Investor diminta mengunjungi alamat website berikut <a href="https://makarya.in/funding">https://makarya.in/funding</a> atau bisa juga diakses melalui menu Funding</p>
          </li>
          <li>
            <p>Selanjutnya investor dapat memilih produk pendanaan. Apabila sudah, investor dapat meng-klik tombol "Danai".</p>
          </li>
          <li>
            <p>Investor selanjutnya diarahkan ke halaman detail produk pendanaan. Dihalaman tersebut, investor dapat membaca nama produk, harga paket, deskripsi produk dan prospektus produk pendanaan.</p>
          </li>
          <li>
            <p>Investor yang ingin melakukan pendanaan pada produk tersebut, diminta memasukkan jumlah paket pendanaan. Jumlah paket pendanaan tidak dapat melebihi saldo makarya.</p>
          </li>
          <li>
            <p>Setelah memasukkan jumlah paket, investor diminta untuk menekan tombol "Danai". Perhatian, investor tidak dapat melakukan pendanaan pada produk yang sama lebih dari satu kali.</p>
          </li>
          <li>
            <p>Setelah selesai, investor akan menerima notifikasi pendanaan berhasil yang dapat dilihat pada menu Notifikasi.</p>
          </li>
          <li>
            <p>Invoice pendanaan akan dikirim kepada investor melalui Notifikasi dan Email setelah produk pendanaan terjual habis atau <em>soldout</em>.</p>
          </li>
        </ol>
        <p>Bagi hasil pendanaan makarya dikirim setelah periode pendanaan selesai. Notifikasi bagi hasil pendanaan dikirim melalui Notifikasi web site makarya dan Email.</p>
      </div>
      <div id="withdraw">
        <h2>Cara tarik saldo</h2>
        <p>Penarikan dana hanya dapat dilakukan apabila saldo investor lebih dari Rp 10.000,-. Biaya transfer ditanggung oleh investor. Berikut ini adalah cara melakukan penarikan saldo makarya,</p>
        <ol>
          <li>
            <p>Investor diminta mengunjungi alamat website <a href="http://makarya.in/transaction/withdraw">http://makarya.in/transaction/withdraw</a></p>
          </li>
          <li>
            <p>Selanjutnya investor diminta menngisi form penarikan dana yaitu nama bank, nomor rekening dan nominal yang akan ditarik.</p>
          </li>
          <li>
            <p>Untuk proses yang lebih cepat, harap masukkan rekening atas nama pribadi (sama seperti akun makarya).</p>
          </li>
        </ol>
        <p>Notifikasi withdraw dikirim melalui notifikasi website makarya.</p>
      </div>
    </div>
  </div>
</div>
@include('components._footer')
@endsection