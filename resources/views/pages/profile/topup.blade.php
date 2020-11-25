@extends('client._components.master')
@section('content')
    @include('client._components.top_nav')
    <div class="container mb-5">
        <div class="row mt-3">
            <div class="col-12 p-2">
                <header class="row border-bottom">
                    <div class="col-12 col-md-6">
                        <h4 class="text-uppercase">Topup</h4>
                    </div>
                </header>
            </div>
        </div>
        <div id="root" class="row mt-3 bg-white shadow-sm">
            <div class="col-12 p-4">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nominal</label>
                    <input v-model="nominal" type="number" class="form-control" id="exampleFormControlInput1" placeholder="Rp.">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Metode Pembayaran</label>
                    <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
                    <datalist id="datalistOptions">
                        <option value="BRI">
                        <option value="BNI">
                        <option value="BCA">
                        <option value="Mandiri">
                    </datalist>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">No. Rekening</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Bukti Pembayaran</label>
                    <input type="file" class="form-control" id="buktiImg" placeholder="name@example.com">
                </div>
                <div class="mb-3 text-right">
                    <button class="btn btn-success">Konfirmasi</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var buktiImg = document.querySelector('#buktiImg');
        var root = new Vue({
            el: '#root',
            data(){
                return {
                    nominal: '',
                    metode: '',
                    rekening: '',
                    bukti: ''
                }
            },
            methods:{
                submit: function(){
                    axios.post(_base+'/v1/topup', {
                        nominal: this.nominal,
                        metode: this.metode,
                        rekening: this.rekening,
                        bukti: buktiImg.files[0]
                    },
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });
                }
            }
        });
    </script>
    @include('client._components.footer')
@endsection