@extends('components.__master')
@section('content')
@include('components._top_navigation')
<div class="container mb-5 px-xl-5">
  <div class="row mt-4" id="menu">
    <div class="col-12 bg-white p-4 border-0 shadow-sm">
      <div>
        <div class="row">
          <div class="col-3">
            @php
              $items = [
                ['_email', 'Konfirmasi Email'],
                ['_card', 'Informasi Umum'],
                ['_pin', 'Alamat'], 
                ['_id', 'Dokumen Pribadi'], 
                ['_document', 'Persetujuan']
              ];
            @endphp
            <ul style="padding-left: 0">
              @foreach ($items as $index => $item)
                <a href="#" class="d-flex flex-row mb-3 text-decoration-none">
                  <span class="badge bg-success d-flex align-items-center mr-2 p-2">
                    @include('icons.'.$item[0])
                  </span>
                  <p class="d-flex align-items-center h-100 mb-0 {{ ($index == $user->level) ? 'text-success' : 'text-dark' }}" style="line-height: 1.8rem">{{ $item[1] }}</p>
                </a>
              @endforeach
            </ul>
          </div>
          <div class="col-9">
            <form class="card border-0" action="{{ url('/getting-started') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card-body" style="min-height: 400px">
                @yield('getting_started_content')
              </div>
              <div class="card-footer text-right">
                <button class="btn btn-success" type="submit">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('components._footer')
@endsection
