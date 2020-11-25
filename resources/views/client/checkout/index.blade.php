@extends('client._components.master')
@section('title') Pesanan @endsection
@section('content')
    @include('client._components.top_nav')
    <div class="container mb-5">
        <div class="row mt-3">
            <div class="col-12 p-2">
                <header class="row border-bottom">
                    <div class="col-12 col-md-6">
                        <h4 class="text-uppercase">Pesanan</span></h4>
                    </div>
                </header>
            </div>
        </div>
        <div class="mt-3" id="checkout-container">
            <div class="list-group">
                <a v-for="checkout in checkouts" v-bind:href="'/checkout/'+checkout.invoice" class="list-group-item list-group-item-action">
                    <div class="d-flex flex-row">
                        <div class="mr-3 d-flex align-items-start">
                            <img v-bind:src="checkout.image" alt="" style="width: 100px; height 100px">
                        </div>
                        <div class="flex-fill">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">@{{ checkout.invoice }}</h5>
                                <span class="badge" 
                                    v-bind:class="{
                                        'bg-warning': (checkout.status == 'menunggu pembayaran'),
                                        'bg-info': (checkout.status == 'menunggu konfirmasi'),
                                        'bg-success': (checkout.status == 'menunggu pengiriman'),
                                    }" style="line-height: 2;">@{{ checkout.status }}</span>
                            </div>
                            <p class="mb-1">@{{ checkout.product }}</p>
                            <small class="text-muted">Rp.@{{ checkout.price }}</small>
                        </div>
                    </div>
                </a>
                <a v-if="loading" v-for="n in 6" class="list-group-item list-group-item-action bg-secondary">
                    <div class="d-flex flex-row">
                        <div class="mr-3 d-flex align-items-start">
                            <div class="bg-white" style="height: 100px; width: 100px">&nbsp;</div>
                        </div>
                        <div class="flex-fill">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1 bg-white" style="width: 100px">&nbsp;</h5>
                                <span class="badge bg-white" style="line-height: 2; width: 100px">&nbsp;</span>
                            </div>
                            <div class="d-flex w-100 justify-content-between">
                                <div>
                                    <p class="mb-1 bg-white" style="width: 80px">&nbsp;</p>
                                    <p class="text-muted bg-white" style="width: 50px">&nbsp;</p>
                                </div>
                                <img class="d-none d-xl-block" src="/image/assets/loading-h.gif" alt="" style="height: 2rem">
                                <p style="width: 180px">&nbsp;</p>
                            </div>
                            
                            
                        </div>
                    </div>
                </a>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <button class="btn btn-success btn-sm" v-on:click="load" v-show="!is_endpage">Muat lebih banyak</button>
                </div>
            </div>
        </div>
    </div>
    @include('client._components.footer')
@endsection
@section('bottom-script')
<script>
    var _base = document.querySelector("base").getAttribute('href');
    console.log(_base);
    var _token = document.querySelector("meta[name='_token']").getAttribute('content');
    var checkout = new Vue({
        el: '#checkout-container',
        data(){
            return{
                loading:true,
                checkouts: [],
                page: 0,
                is_endpage: false,
            }
        },
        mounted(){
            this.load()
        },
        methods:{
            load: function(){
                this.loading = true;
                axios.get(_base+'/v1/checkout', {
                    params: {
                        page: this.page
                    }
                })
                .then(response => {
                    (response.data.length < 6) ? this.is_endpage = true: this.is_endpage = false;
                    response.data.map(data => this.checkouts.push(data))
                    console.log(this.checkouts)
                })
                .finally(() => {
                    this.loading = false;
                    this.page = this.page + 1;
                })
            }
        }
    });
</script>
@endsection