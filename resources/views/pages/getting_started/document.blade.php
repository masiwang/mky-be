@extends('pages.getting_started.components.__layout')
@section('title')
  Lengkapi pendaftaran
@endsection
@section('getting_started_content')
<div class="mb-3">
  <label for="no_ktp" class="form-label">No. KTP</label>
  <input v-model="no_ktp" type="text" class="form-control" name="ktp"/>
  @if (\Session::has('ktp'))
  <span class="text-danger">{{\Session::get('ktp')}}</span>
  @endif
</div>
<div class="mb-3">
  <label for="ktp_image" class="form-label">Foto KTP</label>
  <input type="file" class="form-control" name="image"/>
  @if (\Session::has('image'))
  <span class="text-danger">{{\Session::get('image')}}</span>
  @endif
</div>
<div class="mb-3">
  <label for="no_npwp" class="form-label">No. NPWP (optional)</label>
  <input type="text" class="form-control" name="npwp"/>
</div>
<div class="mb-3">
  <label for="ktp_image" class="form-label">Foto NPWP (optional)</label>
  <input type="file" class="form-control" name="image_npwp"/>
</div>
@endsection
