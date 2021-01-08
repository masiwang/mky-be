@extends('pages.getting_started.components.__layout')
@section('title')
  Lengkapi pendaftaran
@endsection
@section('getting_started_content')
<div class="mb-3 flex-fill">
  <label for="email_token" class="form-label">Token konfirmasi <small class="text-info">*Silahkan cek token di Inbox email Anda</small></label>
  <input type="text" class="form-control" id="email_token" name="email_token">
  @if (\Session::has('error'))
    <small class="text-danger">{{ \Session::get('error') }}</small>
  @endif
  <div class="my-3">
    <div class="mb-3">
      <span class="mr-2">Belum menerima token?</span><a href="/resend-token" class="btn btn-link text-decoration-none">Kirim ulang</a>
    </div>
  </div>
  @if(\Request::has('email'))
  <span class="text-success">{{ \Request::get('email') }}</span>
  @endif

</div>
@endsection