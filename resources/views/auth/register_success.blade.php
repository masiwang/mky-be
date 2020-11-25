@extends('client._components.master')
@section('content')
    @include('client._components.top_nav')
    <div class="container">
        <div class="row mb-3">
            <div class="col-12 py-3">
                <div class="card">
                    <div class="card-body shadow-sm p-4">
                        <p>Silahkan periksa email Anda untuk melakukan konfirmasi registrasi Anda.</p>
                        <div class="text-right"><a href="{{ url('/profile') }}" class="btn btn-success">Pergi ke halaman profile</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('client._components.footer')
@endsection