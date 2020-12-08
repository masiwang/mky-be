@extends('components.__master')
@section('title') Home @endsection
@section('content')
@include('components._top_navigation')
<div class="container mb-5">
  <div class="row mt-4" id="slide">
    <div class="col-12">
      <div class="card-body p-0">
        <div class="row">
          <div class="col-12">
            <h2>Apa itu makarya?</h2>
            <p class="mb-5">makarya merupakan platform digital yang bergerak untuk pendanaan di bidang pertanian, peternakan dan perikanan serta perdagangan hasil produksi di bidang tersebut.</p>
            <h2>Kenapa Makarya?</h2>
            <p>Dengan bergabung di makarya, Anda akan medapatkan banyak manfaat, baik sebagai investor ataupun sebagai mitra. Berikut ini ada 3 manfaat bergabung dengan makarya,</p>
            <ol class="mb-5">
              <li>
                <h5>Keuntungan investor</h5>
                <p>Sebagai investor, Anda akan mendapatkan bagi hasil dari penjualan hasil panen dari para Mitra.</p>
              </li>
              <li>
                <h5>Fokus pengembangan</h5>
                <p>Fokus usaha pengembangan dan pemberdayaan bidang pertanian, peternakan dan perikanan.</p>
              </li>
              <li>
                <h5>kemudahan akses</h5>
                <p>Memberi kemudahan investor dan kesempatan bagi pelaku usaha untuk berkembang.</p>
              </li>
            </ol>
            <h2>Bagaimana Makarya bekerja?</h2>
            <p>berikut ini adalah cara kerja makarya,</p>
            <ol class="mb-5">
              <li>
                <h5>Pilih usaha yang akan didanai</h5>
                <p>Memilih usaha yang dinginkan oleh investor untuk pengembangan usaha dan produk.</p>
              </li>
              <li>
                <h5>Kirim modal usaha</h5>
                <p>mentransfer uang yang akan diberikan pada usaha yang telah dipilih.</p>
              </li>
              <li>
                <h5>Monitor usaha</h5>
                <p>memantau usaha dan nikmati hasilnya</p>
              </li>
            </ol>
            <h2>Bidang usaha mitra Makarya</h2>
            <p class="mb-5">Makarya memilih mitra dari tiga bidang yaitu pertanian, peternakan dan perikanan.</p>
            <h2>Hubungi Makarya</h2>
            <p>Jl. Shinta No. 22, Purwo Asri, RT 40B, RW 016, Kroyo, Karang Malang, Sragen Indonesia</p>
            <p>support@makarya.in</p>
            <p>(+62) 821 3000 4204</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('components._footer')
@endsection