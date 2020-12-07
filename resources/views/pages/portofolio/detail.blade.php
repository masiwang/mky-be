@extends('components.__master')
@section('title')
  Portofolio {{ $portofolio->product->name }}
@endsection
@section('content')
@include('components._top_navigation')
<div class="container mb-5" id="fund-product-detail-container">
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
            <a href="/portofolio" class="text-decoration-none">Portofolio</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">{{ $portofolio->invoice }}</li>
        </ol>
      </nav>
    </div>
    
    <div class="col-sm-12 bg-white shadow-sm py-3">
      <div>
        <div class="row m-3">
          <div class="col-sm-4 text-center">
            <img src="{{ $portofolio->product->image }}" alt="" srcset="" style="width: 100%">
          </div>
          <div class="col-sm-8">
            <form class="row" action="/fund/{{ $portofolio->product->category->name }}/{{ $portofolio->product->name }}" method="POST">
              @csrf
              <h4 class="col-12 mb-4"> {{ $portofolio->product->name }}</h4>
              <div class="col-12 mb-2">
                <span class="text-success">Jumlah investasi</span>
                <h4 class="text-success" style="font-weight: 600">Rp {{ number_format($portofolio->product->price * $portofolio->qty, 2, ',', '.') }}</h4>
              </div>
              <div class="col-12 mb-4">
                <p class="mb-0">
                  {!! $portofolio->product->description !!}
                </p>
              </div>
              <div class="col-12 mb-4">
                <div class="row">
                  <div class="col-3">
                    <strong>Estimasi ROI</strong>
                  </div>
                  <div class="col-9">
                    {{ $portofolio->product->estimated_return }}%
                  </div>
                  <div class="col-3">
                    <strong>Pendanaan selesai</strong>
                  </div>
                  <div class="col-9">
                    {{ date('d M Y', strtotime($portofolio->product->ended_at)) }}
                  </div>
                  <div class="col-3">
                    <strong>ROI Aktual</strong>
                  </div>
                  <div class="col-9">
                    {{ ($portofolio->product->actual_return) ? $portofolio->product->actual_return : '-' }}%
                  </div>
                </div>
              </div>
              <div class="row mb-4">
                <div class="col-12 mb-2">
                  <span class="text-success">Return</span>
                  <h4 class="text-success" style="font-weight: 600">Rp {{ ($portofolio->product->actual_return) ? number_format((($portofolio->product->price * $portofolio->qty)*(1+($portofolio->product->actual_return)/100)), 2, ',', '.') : '-' }}</h4>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-12 bg-white shadow-sm p-4" style="min-height: 400px">
      <h4>Laporan pendanaan</h4>
      <hr>
      <div class="d-flex align-items-start">
        <div class="row">
          <div class="col-3">
            <div class="nav flex-column nav-pills mr-3 bg-light" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="height: 400px; width: 100%">
              @foreach ($reports as $index => $report)
                <a class="nav-link" id="v-pills-{{ $report->id }}-tab" data-toggle="pill" href="#v-pills-{{ $report->id }}" role="tab" aria-controls="v-pills-{{ $report->id }}" aria-selected="{{ ($index == 0) ? 'true' : 'false' }}">{{ $report->title }}</a>
              @endforeach
            </div>
          </div>
          <div class="col-9">
            <div class="tab-content" id="v-pills-tabContent">
              @foreach ($reports as $index => $report)
                <div class="tab-pane fade {{ ($index == 0) ? 'show active' : '' }}" id="v-pills-{{ $report->id }}" role="tabpanel" aria-labelledby="v-pills-{{ $report->id }}-tab">
                  <img src="{{ $report->image }}" alt="" style="max-width: 100%; margin-bottom: 2rem">
                  <div>{!! $report->description !!}</div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
        
        
      </div>
    </div>
  </div>

  <div class="row mb-5">
    <div class="col-12 bg-white shadow-sm p-4" style="min-height: 400px">
      <h4>Prospectus</h4>
      <hr>
      <iframe class="" style="width: 100%; height: 600px" src="{{$portofolio->product->prospectus}}"></iframe>
    </div>
  </div>
</div>
@include('components._footer')
@endsection
