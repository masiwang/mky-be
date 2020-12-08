@extends('components.__master')
@section('title') Home @endsection
@section('content')
@include('components._top_navigation')
<div class="container mb-5">
  <div class="row mt-4" id="slide">
    <div class="col-12">
      <div class="card-body p-0">
        <div class="row">
          <div class="col-12">
            <div id="topCarousel" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#topCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#topCarousel" data-slide-to="1"></li>
                <li data-target="#topCarousel" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="https://images.unsplash.com/photo-1498837167922-ddd27525d352?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&h=370&w=1080"  class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="https://images.unsplash.com/photo-1556762163-542910c8765d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&h=370&w=1080"  class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="https://images.unsplash.com/photo-1544551763-77ef2d0cfc6c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&h=370&w=1080"class="d-block w-100" alt="...">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- Funding --}}
  <div class="row mt-4">
    <div class="col-12 p-2">
      <header class="section-heading heading-line">
        <h4 class="text-uppercase">Funding</h4>
      </header>
    </div>
  </div>
  <div class="row mt-3" id="fund-product-container" style="min-height: 80px;">
    @foreach($fund_products as $fund_product)
      <div class="col-6 col-md-3 mb-4">
        <div class="card card-product shadow-sm mr-2">
          <div style="overflow: hidden">
            <img src="{{$fund_product->image}}" alt="Avatar" class="card-img" style="width: 100%">
          </div>
          <div class="card-body d-flex flex-column">
            <p class="card-title align-self-stretch" style="max-height: 44px; overflow: hidden; font-size: .9rem;">
              <a v-bind:href="/funding/{{$fund_product->category->name}}/{{$fund_product->id}}" class="text-decoration-none text-dark">{{ $fund_product->name }}</a>
            </p>
            <p class="card-text mb-1 text-success">
              <b>Rp {{ number_format($fund_product->price, 0, ',', '.') }}/peket</b>
            </p>
            {{-- <div class="d-flex flex-row w-100" style="font-size: .8rem">
              <div class="col-7"><b>Kontrak</b></div>
              <div class="col-5">{{ $fund_product->periode_length }} hari</div>
            </div> --}}
            <div class="d-flex flex-row w-100" style="font-size: .8rem">
              <div class="col-7"><b>ROI</b></div>
              <div class="col-5">{{ $fund_product->estimated_return }}%</div>
            </div>
            <div class="d-flex flex-row w-100" style="font-size: .8rem">
              <div class="col-7"><b>Sisa stock</b></div>
              <div class="col-5">{{ $fund_product->current_stock }} paket</div>
            </div>
            {{-- <div class="d-flex flex-row w-100 mb-3" style="font-size: .8rem">
              <div class="col-7"><b>Pendanaan selesai</b></div>
              <div class="col-5">{{ date('d M Y', strtotime($fund_product->ended_at)) }}</div>
            </div> --}}
            <div class="w-100">
              <a href="/funding/{{ $fund_product->category->name }}/{{ $fund_product->id }}" class="btn btn-success btn-sm w-100" {{ ($fund_product->current_stock == 0) ? 'disabled' : '' }}>Danai</a>
            </div>
          </div>
        </div>
      </div>
    @endforeach
    <div class="col-12 text-center">
      <a href="{{ url('/funding') }}" class="btn btn-success btn-sm">Muat lebih banyak</a>
    </div>
  </div>
</div>
@include('components._footer')
@endsection