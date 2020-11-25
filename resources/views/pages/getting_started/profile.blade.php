@extends('pages.getting_started.components.__layout')
@section('title')
  Lengkapi pendaftaran
@endsection
@section('getting_started_content')
<div class="mb-3">
  <label for="name" class="form-label">Nama</label>
  <input type="text" class="form-control" id="name" name="name">
  @if (\Session::has('name'))
      <small class="text-danger">{{ \Session::get('name') }}</small>
  @endif
</div>
<div class="row mb-3">
  <div class="col-xl-6">
      <label for="phone" class="form-label">Tanggal Lahir</label>
      <input id="datepicker" class="form-control" name="birthday"/>
      @if (\Session::has('birthday'))
          <small class="text-danger">{{ \Session::get('birthday') }}</small>
      @endif
      <script>
          $("#datepicker").flatpickr();
      </script>
  </div>
  <div class="col-xl-6">
      <p class="form-label">Jenis kelamin</p>
      <input type="hidden" name="gender">
      <select class="form-select"  id="gender" name="gender">
          <option value="1">Laki-laki</option>
          <option value="2">Perempuan</option>
      </select>
      @if (\Session::has('gender'))
          <small class="text-danger">{{ \Session::get('gender') }}</small>
      @endif
  </div>
</div>
<div class="mb-3">
  <label for="phone" class="form-label">Nomor HP</label>
  <input type="text" class="form-control" id="phone" name="phone">
  @if (\Session::has('phone'))
      <small class="text-danger">{{ \Session::get('phone') }}</small>
  @endif
</div>
<div class="mb-3">
  <label for="job" class="form-label">Pekerjaan</label>
  <input type="text" class="form-control" id="job" name="job">
  @if (\Session::has('job'))
      <small class="text-danger">{{ \Session::get('job') }}</small>
  @endif
</div>
@endsection
