@extends('components.__master')
@section('title')
  Pendanaan {{ $fund_product->name }}
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
            <a href="/funding/{{ $fund_product->category->name }}" class="text-decoration-none">
              {{ \Str::ucfirst($fund_product->category->name) }}
            </a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">{{ $fund_product->name }}</li>
        </ol>
      </nav>
    </div>
    
    <div class="col-sm-12 bg-white shadow-sm py-3">
      <div>
        <div class="row m-3">
          <div class="col-sm-4 text-center">
            <img src="{{ $fund_product->image }}" alt="" srcset="" style="width: 100%">
          </div>
          <div class="col-sm-8">
            <form class="row" action="/funding/{{ $fund_product->category->name }}/{{ $fund_product->id }}" method="POST">
              @csrf
              <h4 class="col-12 mb-4"> {{ $fund_product->name }}</h4>
              <div class="col-12 mb-2">
                <h4 class="text-success" style="font-weight: 600">Rp {{ number_format($fund_product->price, 0, ',', '.') }}/paket</h4>
              </div>
              <div class="col-12 mb-4">
                <p class="mb-0">
                  {!! $fund_product->description !!}
                </p>
              </div>
              <div class="col-12 mb-4">
                <div class="row">
                  <div class="col-2">
                    <strong>ROI</strong>
                  </div>
                  <div class="col-10">
                    {{ $fund_product->estimated_return }}%
                  </div>
                  <div class="col-2">
                    <strong>Periode</strong>
                  </div>
                  <div class="col-10">
                    {{ $fund_product->periode_length }} hari
                  </div>
                  <div class="col-2">
                    <strong>Sisa stok</strong>
                  </div>
                  <div class="col-10">
                    {{ $fund_product->current_stock}} paket
                  </div>
                </div>
              </div>
              @if ($fund_product->current_stock < 1)
              <div class="row mb-1">
                <div class="col-12">
                  <h6 class="text-danger">Project pendanaan telah <em>sold out</em> atau selesai.</h6>
                </div>
              </div>
              @else
              <div class="row mb-1">
                <div class="col-10">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Qty</span>
                    <input type="number" class="form-control" placeholder="0" step="1" aria-describedby="basic-addon1" name="qty">
                    <span class="input-group-text">paket</span>
                    <input type="hidden" name="product_id" value="{{ $fund_product->id }}">
                  </div>
                </div>
                <div class="col-2">
                  <input class="btn btn-success w-100" value="Danai" type="submit">
                </div>
              </div>
              @endif
              @if (\Session::has('error'))
                <div class="row mb-4">
                  <span class="text-danger">
                    {{\Session::get('error')}}
                  </span>
                </div>
              @endif
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mb-5">
    <div class="col-12 bg-white shadow-sm p-4" style="min-height: 400px">
      <h4>Prospektus Funding {{ $fund_product->name }}</h4>
      <hr>
      <iframe class="" style="width: 100%; height: 600px" src="{{$fund_product->prospectus}}"></iframe>
    </div>
  </div>
</div>
@include('components._footer')
@endsection
