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
                        <th scope="col"></th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col" width="5%"></th>
                      </tr>
                    </thead>
                    <tbody>
                        @if ($cart_products)
                            @php
                                $total_harga = 0;
                            @endphp
                            @foreach ($cart_products as $cart_product)
                                <tr>
                                    <td>
                                        @if ($cart_product->image)
                                        <img src="/image/{{ $cart_product->image }}" alt="Avatar" style="height: 5rem">
                                        @else
                                        <img src="/image/market-default.png" alt="Avatar" style="height: 5rem">
                                        @endif
                                    </td>
                                    <td><p class="mb-1">{{ $cart_product->name }}</p><small class="text-primary">Sisa stock: {{ $cart_product->stock }}</small></td>
                                    <td>Rp.{{ number_format($cart_product->price,0,",",".") }}/{{ $cart_product->size }}</td>
                                    <td>{{ $cart_product->qty }}</td>
                                    <td>
                                        <a href="{{ url('cart/'.$cart_product->category_slug.'/'.$cart_product->slug.'/delete') }}" class="btn btn-outline-danger w-100">
                                            <span style="position: relative; bottom: 2px">@include('components.icon.trash')</span>
                                        </a>
                                    </td>
                                </tr>
                                @php
                                    $total_harga += (int)($cart_product->price)*(int)($cart_product->qty)
                                @endphp
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td><b>Total</b></td>
                                <td><b>Rp. {{ number_format($total_harga, 0, ',', '.') }}</b></td>
                                <td></td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="5" class="text-center">- Keranjang Anda kosong :( -</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="{{ route('checkout-this-cart') }}" class="btn btn-success" style="position: relative">
                            <span class="text-light" style="position: relative; bottom: 2px">@include('components.icon.cart_check')</span> <span style="position: relative">Checkout</span>
                        </a>
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