@extends('client._components.master')
@section('title') Market @endsection
@section('content')
    @include('client._components.top_nav')
    <div class="container mb-5" id="market-product-container">
        <div class="row mt-3">
            <div class="col-12 p-2">
                <header class="row border-bottom">
                    <div class="col-12 col-md-6">
                        <h4 class="text-uppercase">Produk Market <span id="category-container"></span></h4>
                    </div>
                    <div class="col-12 col md-6">
                        <nav class="nav">
                            <a class="nav-link active" v-on:click="setCategory('semua')">Semua</a>
                            <a class="nav-link" v-on:click="setCategory('sayur')">Sayur</a>
                            <a class="nav-link" v-on:click="setCategory('buah')">Buah</a>
                            <a class="nav-link" v-on:click="setCategory('daging')">Daging</a>
                            <a class="nav-link" v-on:click="setCategory('ikan')">Ikan</a>
                            <a class="nav-link" v-on:click="setCategory('lainnya')">Lainnya</a>
                        </nav>
                    </div>
                </header>
            </div>
        </div>
        <div class="mt-3">
            <div class="row">
                <div v-for="(product, index) in products" class="col-6 col-md-2 p-2">
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
                                <a v-on:click="like(product)" class="btn btn-white text-danger w-100 btn-sm btn-action-like">
                                    <svg v-if="product.is_wishlist" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-heart-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                    </svg>
                                    <svg v-else width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-heart" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
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
                    <button class="btn btn-success btn-sm" v-on:click="more" v-show="!is_endpage">Muat lebih banyak</button>
                </div>
            </div>
        </div>
    </div>
    @include('client._components.footer')
@endsection
@section('bottom-script')
<script>
    var _token = document.querySelector("meta[name='_token']").getAttribute('content');
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
                like_loading: false
            }
        },
        mounted(){
            this.load()
        },
        methods:{
            load: function(){
                axios.get(_base+'/api/market/product', {
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
                    this.page = this.page + 1
                })
            },
            like: function(product){
                axios.post(_base+'/market/wishlist/new', {
                    product: product.id,
                    _token: _token
                })
                .then(response => {
                    console.log(response)
                    // (response.data.length < 6 ) ? this.is_endpage = true : this.is_endpage = false;
                    // response.data.map(data => this.products.push(data))
                })
                .finally(() => {
                    product.is_wishlist = !product.is_wishlist
                })
            },
            more: function(){
                this.loading = true
                this.load()
            },
            setCategory: function(category){
                this.loading = true
                this.category = category
                this.page = 0
                this.products = []
                this.load()
            }
        }
    })
</script>
@endsection