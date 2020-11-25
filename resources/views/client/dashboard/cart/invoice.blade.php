@extends('client._components.master')
@section('content')
    @include('client._components.top_nav')
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background-color: transparent">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Akun</li>
                    </ol>
                </nav>
            </div>
            <hr>
        </div>
        <div class="row mb-5">
            <div class="col-12">
                <div class="row p-3">
                    <div class="col-3 shadow-sm bg-white">
                        @include('client.dashboard.profile._components.side_nav')
                    </div>
                    <div class="col-9 bg-white shadow-sm p-3">
                        <div class="card h-100 border-0">
                            <div class="card-body table-responsive" style="padding: .5rem 6rem">
                                <div class="row">
                                    <div class="col-12 bg-light p-4">
                                        <div class="mb-5 text-center">
                                            <img src="{{ asset('/image/assets/makarya-dark-160x48.png') }}" alt="">
                                            <p>Invoice #{{ $invoice->invoice }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between">
                                                <small class="text-secondary">Pembayaran dari</small>
                                                <small class="text-secondary">Pembayaran ke</small>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <p class="font-weight-bold mb-0">{{ $user->name }}</p>
                                                <p class="font-weight-bold mb-0">Makarya.in</p>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <small>Jl. Burung dara</small>
                                                <small>Jl. Selatan Raya</small>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <small>Surya, Jebres</small>
                                                <small>Jumapolo, Sine</small>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <small>Sragen 57261</small>
                                                <small>Ngawi 67516</small>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between">
                                                <small>&nbsp;</small>
                                                <small class="text-secondary">Tenggat pembayaran</small>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <small>&nbsp;</small>
                                                <p class="font-weight-bold mb-0"></p>
                                            </div>
                                        </div>
                                        <div class="mb-5">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Nama produk</th>
                                                        <th width="15%">Harga</th>
                                                        <th width="10%" class="text-center">Qty</th>
                                                        <th width="10%">Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><a class="text-decoration-none text-success" href="{{ url('/fund/'.$invoice->product->category->slug.'/'.$invoice->product->slug) }}">{{ $invoice->product->name }}</a></td>
                                                        <td>Rp.{{ number_format($invoice->product->price,0,",",".") }}</td>
                                                        <td class="text-center">{{ $invoice->qty }}</td>
                                                        <td>Rp.{{ number_format((int)$invoice->product->price * (int)$invoice->qty,0,",",".") }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" class="font-weight-bold">Total Pembayaran</td>
                                                        <td>Rp.{{ number_format((int)$invoice->product->price * (int)$invoice->qty,0,",",".") }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mb-3">
                                            <small>NOTE</small>
                                            <hr>
                                            <p>Pembayaran yang melewati tenggat tidak akan di proses. Apabila produk habis sebelum Anda melakukan pembayaran, maka Anda tidak dapat melakukan checkout.</p>
                                        </div>
                                        <div>
                                            <div class="col-12 text-right">
                                                @if ($invoice->status->id > 1)
                                                <button href="#" class="btn btn-success btn-sm disabled" disabled>{{ \Str::ucfirst($invoice->status->name) }}</button>
                                                @else
                                                <a href="{{ url('/profile/market/invoice/'.$invoice->invoice.'/pay') }}" class="btn btn-success btn-sm">Konfirmasi pembayaran</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    @include('client._components.footer')
@endsection