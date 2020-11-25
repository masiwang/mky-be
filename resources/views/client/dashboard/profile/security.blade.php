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
                        <form class="card h-100 border-0" action="{{ url('/profile/security/password') }}" method="POST">
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label for="name" class="form-label">Password Lama</label>
                                            <input type="text" class="form-control" id="name" name="password_old" value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label for="phone" class="form-label">Password Baru</label>
                                            <input id="datepicker" class="form-control" name="password_new" placeholder="******"/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label for="phone" class="form-label">Password Baru</label>
                                            <input id="datepicker" class="form-control" name="password_new" placeholder="******"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer border-0 bg-white">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('client._components.footer')
@endsection