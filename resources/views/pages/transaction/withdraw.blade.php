@extends('components.__master')
@section('title')
  Tarik dana
@endsection
@section('content')
@include('components._top_navigation')
<div class="container mb-5" id="root">
  <div class="row my-3">
    <div class="col-12 p-0 shadow-sm mb-4">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item">
            <a href="{{ url('/') }}">
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.5 10.995V14.5a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5V11c0-.25-.25-.5-.5-.5H7c-.25 0-.5.25-.5.495z"/>
                <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
              </svg>
            </a>
          </li>
          <li class="breadcrumb-item">
            <a href="/transaction" class="text-decoration-none">Transaksi</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Withdraw</li>
        </ol>
      </nav>
    </div>

    <div class="col-sm-12 bg-white shadow-sm py-3">
      <form class="p-3" action="/transaction/withdraw" method="POST">
        @csrf
        <div class="mb-3">
          <label for="bank" class="form-label">Bank Tujuan</label>
          <input type="text" class="form-control" name="bank_type">
          @if (\Session::has('bank_type'))
            <span class="text-danger">{{ \Session::get('bank_type') }}</span>
          @endif
        </div>
        <div class="mb-3">
          <label for="acc" class="form-label">No. Rekening</label>
          <input type="number" class="form-control" name="bank_acc">
          @if (\Session::has('bank_acc'))
            <span class="text-danger">{{ \Session::get('bank_acc') }}</span>
          @endif
        </div>
        <div class="mb-3">
          <label for="nominal" class="form-label">Nominal</label>
          <input type="number" class="form-control" name="nominal">
          @if (\Session::has('nominal'))
            <span class="text-danger">{{ \Session::get('nominal') }}</span>
          @endif
        </div>
        <div class="mb-3">
          <p class="text-dark" style="font-size: .8rem">
            NB:<br/>
            - Permintaan tarik dana tidak dapat dibatalkan<br/>
            - Permintaan tarik dana pada hari Senin s/d Kamis, dilayani pada hari berikutnya pukul 09.00 WIB hingga 13.00 WIB<br/>
            - Permintaan tarik dana pada hari Jum'at s/d Minggu, dilayani pada hari Senin<br/>
            - Penarikan dana ke Rekening Bank selain BNI dan BNI Syariah dikenakan biaya sebesar Rp 6.500,-
          </p>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
          @if (!$user->ktp_verified_at)
            <span class="text-danger">Maaf akun Anda belum diverifikasi oleh pihak Makarya</span>
          @else
            <span>&nbsp;</span>
          @endif
          <input class="btn btn-success {{ (!$user->ktp_verified_at) ? 'disabled' : '' }}" type="submit" value="Konfirmasi" />
        </div>
      </form>
    </div>
  </div>
</div>
@include('components._footer')
@endsection