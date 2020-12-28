@extends('components.__master')

@section('title') Pendanaan @endsection

@section('content')
@include('components._top_navigation')
<div class="container mb-5" id="fund-product-container">
  <div class="row mt-3">
    <div class="col-12 p-2">
      <header class="row border-bottom">
        <div class="col-12 col-md-6">
          <h4 class="text-uppercase">Produk Funding</h4>
        </div>
        <div class="col-12 col md-6">
          <nav class="nav">
            <a class="nav-link" href="{{ url('/funding') }}">Semua</a>
            <a class="nav-link" href="{{ url('/funding/pertanian') }}">Pertanian</a>
            <a class="nav-link" href="{{ url('/funding/peternakan') }}">Peternakan</a>
            <a class="nav-link" href="{{ url('/funding/perikanan') }}">Perikanan</a>
          </nav>
        </div>
      </header>
    </div>
  </div>
  <div class="mt-3">
    <div class="row">
      @foreach ($fund_products as $fund_product)
        <div class="col-6 col-md-2 p-2">
          <div class="card card-product h-100 shadow-sm">
            <div class="card-product__image-container" style="overflow: hidden">
              <a href="/funding/{{\Str::lower($fund_product->category->name)}}/{{$fund_product->id}}" >
                <img src="{{ $fund_product->image }}" alt="Avatar" class="card-img-top" style="width: 100%;">
              </a>
            </div>
            <div class="card-body d-flex align-items-start flex-column">
              <strong>{{ $fund_product->vendor->name }}</strong>
              <p class="mb-auto" style="max-height: 44px; overflow: hidden; font-size: .9rem;">
                <a href="/funding/{{\Str::lower($fund_product->category->name)}}/{{$fund_product->id}}" style="text-decoration:none" class="text-dark">
                  {{ \Str::of($fund_product->name)->title() }}
                </a>
              </p>
              <p class="card-text mb-1 text-success">
                <strong>Rp {{ number_format($fund_product->price, 0,',', '.') }}/paket</strong>
              </p>
              <div class="d-flex flex-row w-100" style="font-size: .8rem">
                <div class="col-6">
                  <strong>ROI</strong>
                </div>
                <div class="col-6">
                  {{ $fund_product->estimated_return }}%
                </div>
              </div>
              <div class="d-flex flex-row w-100" style="font-size: .8rem">
                <div class="col-6">
                  <strong>Stok</strong>
                </div>
                <div class="col-6">
                  {{ $fund_product->current_stock }} paket
                </div>
              </div>
              <div class="w-100">
                @if ($fund_product->current_stock > 0)
                  <a href="/funding/{{\Str::lower($fund_product->category->name)}}/{{$fund_product->id}}" class="btn btn-success btn-sm w-100">
                    Danai
                  </a>
                @else
                  @if ((strtotime(\Carbon\Carbon::now()) - strtotime($fund_product->ended_at)) > 0)
                    <a href="/funding/{{\Str::lower($fund_product->category->name)}}/{{$fund_product->id}}" class="btn btn-success btn-sm w-100 disabled">
                    Selesai
                    </a>
                  @else
                  <a href="/funding/{{\Str::lower($fund_product->category->name)}}/{{$fund_product->id}}" class="btn btn-success btn-sm w-100 disabled">
                    Berlangsung
                  </a>
                  @endif
                @endif
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <div class="mb-4 d-flex justify-content-center">
      {{ $fund_products->links() }}
    </div>
  </div>
</div>
@include('components._footer')
@endsection
