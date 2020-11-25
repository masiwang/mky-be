@extends('client._components.master')
@section('content')
    @include('client._components.top_nav')
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background-color: transparent">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/market') }}" class="text-decoration-none">Market</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/market/'.$product->category->slug) }}" class="text-decoration-none">{{ $product->category->name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                    </ol>
                </nav>
            </div>
            <hr>
        </div>
        <div class="row mb-3">
            <div class="col-sm-12 bg-white shadow-sm">
                <form action="{{ url('market/'.$product->category->slug.'/'.$product->slug.'/buy') }}" method="POST">
                    @csrf
                    <div class="row m-3">
                        <div class="col-sm-5 text-center" style="overflow:hidden; height: 400px">
                            @if ($product->image)
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{ $product->image }}" class="d-block w-100" alt="...">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            @else
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="/image/assets/product-default.png" class="d-block w-100" alt="...">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            @endif
                        </div>
                        <div class="col-sm-7">
                            <div class="row">
                                <h4 class="col-12">{{ $product->name }}</h4>
                                <small class="col-12 text-info mb-4">Lokasi gudang</small>
                                <div class="col-12 mb-4">
                                    <h4 class="text-success" style="font-weight: 600">Rp. {{ number_format($product->price,0,",",".") }}/unit</h4>
                                </div>
                                <div class="col-12">
                                    <p>Tersedia : {{ $product->stock }} unit</p>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-5">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">Qty</span>
                                            <input type="hidden" name="product" value="{{ $product->slug }}">
                                            <input type="hidden" name="price" value="{{ $product->price }}">
                                            <input class="form-control" type="number" placeholder="0" name="qty">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <h5 class="text-success"><span class="text-dark">Estimasi harga: </span>Rp. <span id="estimasi">0</span></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        @if($user->email_verified_at && $user->ktp_verified_at)
                                        <button class="btn btn-success w-100 pb-1" style="position: relative">
                                            <span class="text-light" style="position: relative;"><i class="fas fa-shopping-cart"></i> Beli</span>
                                        </button>
                                        @else
                                        <div class="alert alert-danger" role="alert">
                                            Untuk melakukan pendanaan, harap konfirmasi alamat email dan Kartu Tanda Penduduk Anda.
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-12 bg-white shadow-sm p-3" style="min-height: 400px">
                <ul class="nav nav-tabs" id="myTab" role="tablist" style="padding: 1rem 0;">
                    <li class="nav-item" role="presentation">
                        <a class="ma-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Deskripsi</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                        <div class="row">
                            <div class="col-12 p-4">
                                <p>{{ $product->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function addCommas(nStr)
        {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + '.' + '$2');
            }
            return x1 + x2;
        }
        var price = $('input[name=price]');
        var qty = $('input[name=qty]');
        var est = $('#estimasi');
        qty.on('keyup', function(){
            est.text(addCommas(price.val() * qty.val()));
        });
        qty.on('change', function(){
            est.text(addCommas(price.val() * qty.val()));
        });
    </script>
    @include('client._components.footer')
@endsection