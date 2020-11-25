@extends('app')
@section('content')
    @include('components.navigation.topnav')
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
                    </ol>
                </nav>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="col-sm-12" style="min-height: 400px">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col" width="20%">Invoice</th>
                        <th scope="col">Jumlah Pembayaran</th>
                        <th>Alamat Pengiriman</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if ($checkouts)
                            @foreach ($checkouts as $checkout)
                                <tr>
                                    <td>{{ $checkout->invoice_code }}</td>
                                    <td>Rp.</td>
                                    <td>Jl.</td>
                                    <td>
                                        <p class="mb-1">{{ $checkout->status }}</p>
                                        @if ($checkout->status_id == 2)
                                        <a href="{{ url('payment/'.$checkout->invoice_code.'/fund') }}" class="text-decoration-none">Bayar sekarang</a><br>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">- Keranjang Anda kosong :( -</td>
                            </tr>
                        @endif
                    </tbody>
                  </table>
                  <div class="row">
                      <div class="col-12 text-right">
                          <small class="text-danger">*)tenggat pembayaran 24 jam setelah anda checkout</small>
                        </div>
                  </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-12">
                <hr>
                <h3 class="mb-3">Rekomendasi</h3>
                <div class="row">
                    @foreach ($recommends as $recommend)
                        <div class="col-xl-2 col-md-3 col-sm-4 col-6 mb-3 d-flex align-items-stretch" >
                            <div class="card" style="">
                                @if ($recommend->image)
                                <img src="/image/{{ $recommend->image }}" alt="Avatar" class="card-img-top">
                                @else
                                <img src="/image/market-default.png" alt="Avatar" class="card-img-top">
                                @endif
                                <div class="card-body d-flex align-items-start flex-column">
                                    <p class="card-title mb-auto" style="max-height: 44px; overflow: hidden; font-size: .9rem;">
                                        <a href="{{ url('market/'.$recommend->category.'/'.$recommend->slug) }}" class="text-decoration-none text-dark">
                                            {{ $recommend->name }}
                                        </a>
                                    </p>
                                    <p class="card-text"><b>Rp{{ number_format($recommend->price,0,",",".") }}/{{ $recommend->size }}</b></p>
                                    <div class="d-flex flex-row" style="font-size: .8rem; width: 100%">
                                        <div class="col-6">
                                            <p class="mb-0" style="position: relative">
                                                <span class="text-danger" style="position: relative; bottom: 2px">@include('components.icon.heart')</span>
                                                <span style="position: relative">100</span>
                                            </p>
                                        </div>
                                        <div class="col-6 text-right">
                                            <p class="mb-0" style="position: relative">
                                                <span class="text-success" style="position: relative; bottom: 2px;">@include('components.icon.bag')</span>
                                                <span style="position: relative;"> 200</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
    @include('components.navigation.footer')
    @include('components.navigation.copyright')
@endsection