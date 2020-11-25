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
                        <form class="card h-100 border-0 border-top" action="{{ url('/profile/market/invoice/'.$invoice->invoice.'/pay') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body table-responsive">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Invoice</label>
                                    <input type="text" disabled class="form-control" id="exampleFormControlInput1" name="invoice" value="{{ $invoice->invoice }}">
                                </div>
                                <div class="mb-3">
                                    <label for="payImage" class="form-label">Bukti pembayaran</label><br>
                                    <input type="file" class="" id="payImage" name="image">
                                </div>
                                <div class="mb-3">
                                    <label for="payBy" class="form-label">No. rekening</label>
                                    <input type="number" class="form-control" id="payBy" name="pay_by" value="">
                                </div>
                            </div>
                            <div class="card-footer text-right border-0 bg-white">
                                <button class="btn btn-success">Konfirmasi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    @include('client._components.footer')
@endsection