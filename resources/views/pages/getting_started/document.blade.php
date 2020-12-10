@extends('pages.getting_started.components.__layout')
@section('title')
  Lengkapi pendaftaran
@endsection
@section('getting_started_content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
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
@endsection
