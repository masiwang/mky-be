@extends('components.__master')
@section('title') Portofolio @endsection
@section('content')
@include('components._top_navigation')
<div class="container mb-5">
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
          <li class="breadcrumb-item active" aria-current="page">Portofolio</li>
        </ol>
      </nav>
    </div>

    <div class="list-group bg-white" style="height: 600px; overflow-y: scroll">
      @foreach ($portofolios as $portofolio)
        <a href="/portofolio/{{ $portofolio->invoice }}" class="list-group-item list-group-item-action shadow-none border-0 shadow-sm">
          <div class="d-flex flex-row py-2">
            <div class="mr-3 d-flex align-items-start">
              <img src="{{ $portofolio->product->image}}" alt="" style="width: 100px; height 100px">
            </div>
            <div class="flex-fill">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{ $portofolio->invoice }}</h5>
              </div>
              <p class="mb-1">{{ $portofolio->product->name }}</p>
              <small class="text-muted">Rp {{ number_format($portofolio->qty * $portofolio->product->price, 0, ',', '.') }}</small><br/>
              @if ($portofolio->return_sent_at)
              <span class="badge bg-success">Pendanaan selesai</span>
              @else
              <span class="badge bg-warning">Sedang berjalan</span>
              @endif
            </div>
          </div>
        </a>
      @endforeach
    </div>
  </div>
</div>
@include('components._footer')
@endsection