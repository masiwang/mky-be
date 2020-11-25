@extends('pages.getting_started.components.__layout')
@section('title')
  Lengkapi pendaftaran
@endsection
@section('getting_started_content')
<div class="mb-3">
  <label for="jalan" class="form-label">Jalan</label>
  <input type="text" class="form-control" name="jalan">
</div>
<div class="row mb-3">
  <div class="col-xl-6">
    <label for="provinsi" class="form-label">Provinsi</label>
    <input class="form-control" list="provinsiList" id="provinsi" name="provinsi" placeholder="Ketik untuk mencari...">
    <datalist id="provinsiList">
    </datalist>
  </div>
  <div class="col-xl-6">
    <label for="kabupaten" class="form-label">Kabupaten/ Kota</label>
    <input class="form-control" list="kabupatenList" id="kabupaten" name="kabupaten" placeholder="Ketik untuk mencari...">
    <datalist id="kabupatenList">
    </datalist>
  </div>
</div>
<div class="row mb-3">
  <div class="col-xl-4">
    <label for="kecamatan" class="form-label">Kecamatan</label>
    <input class="form-control" list="kecamatanList" id="kecamatan" name="kecamatan" placeholder="Ketik untuk mencari...">
    <datalist id="kecamatanList">
    </datalist>
  </div>
  <div class="col-xl-4">
    <label for="kelurahan" class="form-label">Desa/ Kelurahan</label>
    <input class="form-control" list="kelurahanList" id="kelurahan" name="kelurahan" placeholder="Ketik untuk mencari...">
    <datalist id="kelurahanList">
    </datalist>
  </div>
  <div class="col-xl-4">
    <label for="kodepos" class="form-label">Kode pos</label>
    <input type="text" id="kodepos" name="kodepos" class="form-control">
  </div>
</div>
<div class="mb-3">
@if (\Session::has('error'))
  <span class="text-danger">
    {{\Session::get('error')}}
  </span>
@else
  <span class="text-info">
    Alamat harus sesuai dengan KTP
  </span>
@endif
</div>
<input type="hidden" id="_csrf" value="{{ csrf_token() }}">
<script src="/js/address.js"></script>
@endsection