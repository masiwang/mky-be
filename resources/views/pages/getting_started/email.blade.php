@extends('pages.getting_started.components.__layout')
@section('title')
  Lengkapi pendaftaran
@endsection
@section('getting_started_content')
<div class="mb-3 flex-fill">
  <label for="email_token" class="form-label">Token konfirmasi</label>
  <input type="text" class="form-control" id="email_token" name="email_token">
  @if (\Session::has('error'))
    <small class="text-danger">{{ \Session::get('error') }}</small>
  @endif
</div>
@endsection