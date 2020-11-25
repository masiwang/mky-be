@extends('client._components.master')
@section('content')
    @include('client._components.top_nav')
    <div class="container mb-5" id="checkout-detail-container">
        <div class="row mt-3">
            <div class="col-12 p-2">
                <header class="row border-bottom">
                    <div class="col-12 col-md-6">
                        <h4 class="text-uppercase">Pesanan <span>@{{ checkout.invoice }}</span></h4>
                    </div>
                </header>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-12 bg-white shadow-sm p-3">
                <form action="" method="POST">
                    <div class="row m-3">
                        <div class="col-12 col-md-5 text-center">
                            <div v-if="loading" class="bg-secondary" style="height: 400px; width: 100%"></div>
                            <img v-else v-bind:src="checkout.image" alt="" srcset="" style="width: 100%">
                        </div>
                        <div class="col-12 col-md-7">
                            <div class="">
                                <h4>@{{ checkout.product }}</h4>
                                <h4 v-show="loading" class="bg-secondary mb-1" style="width: 150px">&nbsp;</h4>

                                <span class="badge mb-3" v-bind:class="{
                                    'bg-danger': (checkout.status == 'menunggu pembayaran'),
                                    'bg-warning': (checkout.status == 'menunggu konfirmasi'),
                                    'bg-info': (checkout.status == 'pendanaan berlangsung'),
                                    'bg-success': (checkout.status == 'pendanaan selesai'),
                                }">@{{ checkout.status }}</span> <a v-bind:href="'/checkout/'+checkout.invoice+'/pay'" class="badge bg-success text-white" v-show="(checkout.status == 'menunggu pembayaran')">Bayar sekarang</a>
                                <p v-show="loading" class="bg-secondary mb-3" style="width: 160px">&nbsp;</p>
                                <hr>
                                <div v-show="loading" class="bg-secondary mb-2" style="width: 100%; height: 220px">&nbsp;</div>
                                <table v-show="!loading" class="table">
                                    <tr>
                                        <th>Pembayaran</th>
                                        <td>@{{ checkout.pay_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>Konfirmasi Pembayaran</th>
                                        <td>@{{ checkout.pay_confirmed_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pengiriman</th>
                                        <td>@{{ checkout.sent_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>Diterima</th>
                                        <th>@{{ checkout.received_at }}</th>
                                    </tr>
                                </table>
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
                                <iframe class="bg-secondary" style="width: 100%; height: 600px" v-bind:src="checkout.description"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('client._components.footer')
@endsection

@section('bottom-script')
    <script>
        var _base = document.querySelector("base").getAttribute('href');
        var checkoutDetail = new Vue({
        el: '#checkout-detail-container',
        data(){
            return{
                loading:true,
                checkout: '',
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
                axios.get(_base+'/v1/checkout/'+window.location.pathname.split('/')[2])
                .then(response => {
                    this.checkout = response.data
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