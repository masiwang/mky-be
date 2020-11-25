@extends('client._components.master')
@section('content')
    @include('client._components.top_nav')
    <div class="w-100 mb-5" style="height: 100vh; background-image: url('/image/assets/vegetables-unsplash-wallpaper.jpg'); background-size: cover; background-posision: center">
        <div class="h-100 d-flex align-items-stretch" style="background-color: #00000099">
            <div class="row">
                <div class="col-12 h-100 d-flex justify-content-center align-items-center">
                    <div class="text-center">
                        <h1 class="text-white mb-0" style="font-size: 6rem; font-weight: 600">Bersama Makarya</h1>
                        <h2 class="text-white mb-4" style="font-size: 2.3rem;font-weight: 600">Membangun negeri dimulai dari sini</h2>
                        <button class="btn btn-success">Yuk mulai!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="height: 5rem"></div>
    <div class="container">
        <div class="mb-4 text-center">
            <h6 class="font-weight-bold">TENTANG MAKARYA</h6>
            <h2 class="h1 font-weight-bold">Apa itu <span class="text-success">Makarya?</span></h2>
        </div>
        <div class="row mb-5 d-flex align-items-stretch">
            <div class="col-12 col-xl-6 text-center">
                <p class="mb-0" style="font-size: 10rem; font-weight: 800; line-height: 10rem">28</p>
                <span class="font-weight-bold">Mitra telah bergabung</span>
            </div>
            <div class="col-12 col-xl-6 d-flex align-items-center">
                <p style="line-height: 2rem">
                    Makarya merupakan platform digital yang bergerak untuk pendanaan dibidang Pertanian, Peternakan dan Perikanan serta Perdagangan hasil produksi di bidang tersebut. Bersama Makarya, membangun peradaban dengan mendukung pertanian.
                </p>
            </div>
        </div>
    </div>
    <div style="height: 5rem"></div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-8">
                <div class="mb-3">
                    <h2 class="h1 font-weight-bold mb-3">Kenapa <span class="text-success">Makarya?</span></h2>
                    <p style="font-size: 18px">
                        Dengan bergabung di Makarya, Anda akan mendapatkan banyak manfaat, baik sebagai investor ataupun sebagai mitra.
                    </p>
                </div>
                <div class="row">
                    <div class="col-4 px-4 d-flex align-items-stretch">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body rounded" style="background-color: #e8f2e8">
                                <p class="text-success mb-2">01</p>
                                <h4 class="font-weight-bold mb-3">Keuntungan Investor</h4>
                                <p class="text-secondary">Sebagai Investor Anda akan mendapatkan bagi hasil dari penjualan hasil panen dari para Mitra</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 px-4 d-flex align-items-stretch">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body rounded" style="background-color: #e8f2e8">
                                <p class="text-primary mb-2">02</p>
                                <h4 class="font-weight-bold mb-3">Fokus Pengembangan</h4>
                                <p class="text-secondary">Fokus usaha pengembangan dan pemberdayaan bidang Pertanian, Peternakan dan Perikanan</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 px-4 d-flex align-items-stretch">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body rounded" style="background-color: #e8f2e8">
                                <p class="text-primary mb-2">03</p>
                                <h4 class="font-weight-bold mb-3">Kemudahan Akses</h4>
                                <p class="text-secondary">Memberi kemudahan Investor & kesempatan bagi pelaku usaha untuk berkembang</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4">
                <img src="/image/assets/makarya-farmer.png" alt="" style="width: 100%">
            </div>
        </div>
        
    </div>
    <div style="height: 5rem"></div>
    <div class="container">
        <div class="mb-4">
            <h2 class="h1 font-weight-bold mb-3">Bagaimana <span class="text-success">Makarya</span> bekerja?</h2>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 text-center">
                <img class="mb-4" src="/image/assets/makarya-vector-02-480x295.png" alt="" width="100%">
                <h3 class="h3">Pilih Usaha yang Didanai</h3>
                <p class="text-secondary">Pilih usaha yang diingin oleh investor untuk pengembangan usaha dan produk</p>
            </div>
            <div class="col-12 col-md-4 text-center">
                <img class="mb-4" src="/image/assets/makarya-vector-03-480x295.png" alt="" width="100%">
                <h3 class="h3">Kirim Modal Usaha</h3>
                <p class="text-secondary">Transfer uang yang akan diberikan pada usaha yang dipilih</p>
            </div>
            <div class="col-12 col-md-4 text-center">
                <img class="mb-4" src="/image/assets/makarya-vector-04-480x295.png" alt="" width="100%">
                <h3 class="h3">Monitor Usaha</h3>
                <p class="text-secondary">Pantau usaha yang anda pilih dan nikmati hasilnya</p>
            </div>
        </div>
    </div>
    <div style="height: 5rem"></div>
    <div class="container">
        <div class="mb-3">
            <h6 class="font-weight-bold text-muted">MITRA USAHA KAMI</h6>
            <h2 class="h1 font-weight-bold mb-3">Bidang Usaha <span class="text-success">Mitra Makarya</span></h2>
        </div>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="d-flex align-items-end justify-content-center rounded" style="height: 300px; overflow: hidden; background-image: url('/image/assets/vegetables-unsplash-wallpaper-330x330.jpg'); background-size:cover; background-position:center">
                    <h3 class="text-light font-weight-bold">Pertanian</h3>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="d-flex align-items-end justify-content-center rounded" style="height: 300px; overflow: hidden; background-image: url('/image/assets/makarya-sheep-330x330.jpg'); background-size:cover; background-position:center">
                    <h3 class="text-light font-weight-bold">Peternakan</h3>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="d-flex align-items-end justify-content-center rounded" style="height: 300px; overflow: hidden; background-image: url('/image/assets/makarya-fishery-330x330.jpg'); background-size:cover; background-position:center">
                    <h3 class="text-light font-weight-bold">Perikanan</h3>
                </div>
            </div>
        </div>
    </div>
    {{-- <div style="height: 5rem"></div>
    <div class="container">
        <div class="mb-3">
            <h6 class="font-weight-bold text-muted">HASIL USAHA MITRA</h6>
            <h2 class="h1 font-weight-bold mb-3">Beli Hasil Usaha <span class="text-success">Mitra Makarya</span></h2>
        </div>
        <div class="mt-3" id="market-product-container">
            <div class="row">
                <div v-for="product in products" class="col-6 col-md-2 p-2">
                    <div class="card card-product h-100 shadow-sm">
                        <div class="card-product__image-container" style="overflow: hidden">
                            <img v-bind:src="product.image" alt="Avatar" class="card-img-top" style="width: 100%;">
                        </div>
                        <div class="card-body p-2 d-flex flex-column">
                            <p class="product-title align-self-stretch" style="max-height: 44px; overflow: hidden; font-size: .9rem;">
                                <a v-bind:href="'/market/'+product.category+'/'+product.slug" class="text-decoration-none">@{{ product.name }}</a>
                            </p>
                            <p class="card-text mb-1 text-success"><strong>Rp.@{{ product.price }}</strong></p>
                            <hr>
                            <div class="mb-1 d-flex justify-content-between">
                                <a v-if="product.is_wishlist" v-on:click="like(product)" class="btn btn-white text-danger w-100 btn-sm btn-action-like">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-heart-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                    </svg>
                                </a>
                                <a v-else v-on:click="like(product)" class="btn btn-white text-danger w-100 btn-sm btn-action-like">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-heart" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                    </svg>
                                </a>
                                <a v-bind:href="'/market/'+product.category+'/'+product.slug" class="btn btn-white text-success w-100 btn-sm">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                        <path fill-rule="evenodd" d="M8.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-show="loading" v-for="n in 6" class="col-6 col-md-2 p-2">
                    <div class="card card-product h-100 shadow-sm bg-secondary">
                        <div style="height: 160px" class="d-flex justify-content-center align-items-center">
                            <img src="/image/assets/loading.gif" alt="" width="80px">
                        </div>
                        <div class="card-body p-2 d-flex flex-column">
                            <p class="product-title align-self-stretch w-100 bg-white" style="max-height: 44px; overflow: hidden; font-size: .9rem;">
                                <a href="#" class="text-decoration-none">
                                    &nbsp;
                                </a>
                            </p>
                            <p class="card-text mb-1 text-success bg-white">&nbsp;</p>
                            <hr>
                            <div class="mb-1 d-flex justify-content-between">
                                <p class="mb-0 btn btn-white w-100 bg-white">
                                    &nbsp;
                                </p>
                                <p class="mb-0 btn btn-white w-100 bg-white">
                                    &nbsp;
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <a class="btn btn-success btn-sm p-2" href="{{ url('/market') }}">Muat lebih banyak</a>
                </div>
            </div>
        </div>
    </div> --}}
    <div style="height: 5rem"></div>
    @include('client._components.footer')
@endsection
{{-- @section('bottom-script')
    <script>
        var _base = document.querySelector('base').getAttribute('href');
        var marketProductGet = new Vue({
            el: '#market-product-container',
            data(){
                return{
                    loading: true,
                    products: [],
                    page: 0,
                    category: 'all',
                    is_endpage: false,
                    per_page: 4
                }
            },
            mounted(){
                this.load();
            },
            methods:{
                load: function(){
                    axios.get(_base+'/v1/market/guest', {
                        params: {
                            category: this.category,
                            page: this.page
                        }
                    })
                    .then(response => {
                        (response.data.length < 6 ) ? this.is_endpage = true : this.is_endpage = false;
                        response.data.map(data => this.products.push(data))
                    })
                    .finally(() => {
                        this.loading = false;
                        this.page = this.page + 1;
                    })
                }
            }
        });
    </script>
@endsection --}}