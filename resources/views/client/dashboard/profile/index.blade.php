@extends('client._components.master')
@section('content')
    @include('client._components.top_nav')
    <div class="container mb-5">
        <div class="row mt-3">
            <div class="col-12 p-2">
                <header class="row border-bottom">
                    <div class="col-12 col-md-6">
                        <h4 class="text-uppercase">Profile</h4>
                    </div>
                </header>
            </div>
        </div>
        <div id="profileIndexContainer" class="row mt-3 bg-white shadow-sm">
            <div class="col-3 p-4 border-right">
                <div>
                    <img src="/image/assets/user.png" alt="" srcset="" style="width: 100%">
                </div>
                <div class="mt-3">
                    <small class="text-secondary text-uppercase">Menu</small>
                    <ul class="nav flex-column" id="profileTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="personalInfo-tab" data-toggle="tab" href="#personalInfo" role="tab" aria-controls="personalInfo" aria-selected="true">Informasi pribadi</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="transaction-tab" data-toggle="tab" href="#transaction" role="tab" aria-controls="transaction" aria-selected="false">Transaksi</a>
                        </li>
                        <a type="button" class="btn btn-success btn-sm mb-2" href="/transaction/topup">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-credit-card" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"/>
                                <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"/>
                              </svg> Topup
                            </a>
                        <a type="button" class="btn btn-primary btn-sm" href="/transaction/withdraw">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                              </svg> Withdraw
                        </a>
                      </ul>
                </div>
            </div>
            <div class="col-9 p-4">
                <div class="mb-4">
                    <div class="d-flex flex-row align-items-end">
                        <h2 class="mb-1 mr-4">{{ $user->name }}</h2> <p class="mb-2 text-secondary">{{ $user->job }} <span class="badge bg-primary"> {{ ($user->gender === 1) ? 'L' : 'P' }}</span></p>
                    </div>  
                    <p class="text-info">
                        <span>
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-geo-alt" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.166 8.94C12.696 7.867 13 6.862 13 6A5 5 0 0 0 3 6c0 .862.305 1.867.834 2.94.524 1.062 1.234 2.12 1.96 3.07A31.481 31.481 0 0 0 8 14.58l.208-.22a31.493 31.493 0 0 0 1.998-2.35c.726-.95 1.436-2.008 1.96-3.07zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                                <path fill-rule="evenodd" d="M8 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>
                        </span>
                        {{ $user->kabupaten }}, {{ $user->kodepos }}</p>
                </div>
                <div class="mb-4">
                    <small class="text-muted"><span class="text-uppercase mr-3">Saldo Makarya Anda ok</span>
                    </small>
                    <h4>Rp.{{ $saldo }}</h4>

                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="personalInfo" role="tabpanel" aria-labelledby="personalInfo-tab">
                        <div class="mb-4">
                            <small class="text-muted text-uppercase">Informasi personal</small>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="20%">Tanggal lahir</th>
                                    <td>
                                        {{ $user->birthday }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>KTP</th>
                                    <td>
                                        {{ $user->ktp }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="mb-4">
                            <small class="text-muted text-uppercase">Informasi kontak</small>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="20%">Alamat</th>
                                    <td>
                                        {{ $user->jalan }}, {{$user->kelurahan}}, {{$user->kecamatan}}, {{$user->kabupaten}}, {{$user->kodepos }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Telepon</th>
                                    <td>
                                        {{ $user->phone }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                              </svg> edit profile
                        </button>
                    </div>
                    <div class="tab-pane fade" id="transaction" role="tabpanel" aria-labelledby="transaction-tab" style="height: 400px; overflow-y: scroll">
                        <div class="p-3">
                            <table class="table table-hover">
                                @foreach ($transactions as $transaction)
                                <tr>
                                    <td width="25%">{{ $transaction->created_at }}</td>
                                    <td>{{ ($transaction->type == 'in') ? 'Masuk' : 'Keluar'}}</td>
                                    <td>Rp.{{($transaction->nominal) }}</td>
                                </tr>    
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <form class="modal-content" action="{{ url('/profile') }}" method="POST">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div  class="row g-3">
                        @csrf
                        <div class="col-md-4">
                            <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                        </div>
                        <div class="col-md-4">
                            <label for="phone" class="form-label">Tanggal Lahir</label>
                        <input id="datepicker" class="form-control" name="birthday" value="{{$user->birthday}}">
                            @if (\Session::has('birthday'))
                                <small class="text-danger">{{ \Session::get('birthday') }}</small>
                            @endif
                            <script>
                                $("#datepicker").flatpickr();
                            </script>
                        </div>
                        <div class="col-md-4">
                            <p class="form-label">Jenis kelamin</p>
                            <input type="hidden" name="gender">
                            <select class="form-select"  id="gender" name="gender">
                                @if ($user->gender==1)
                                <option selected value="1">Laki-laki</option>
                                <option value="2">Perempuan</option>    
                                @else
                                <option value="1">Laki-laki</option>
                                <option selected value="2">Perempuan</option>    
                                @endif
                            </select>
                        </div>
                        <div class="col-md-6">
                          <label for="inputAddress2" class="form-label">No KTP</label>
                        <input type="text" class="form-control" id="inputAddress2" value="{{$user->ktp}}">
                        </div>
                        {{-- <div class="col-md-6">
                            <label for="job" class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{$user->job}}">
                        </div> --}}
                        {{-- <div class="col-md-6">
                            <label for="phone" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}">
                        </div> --}}
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Nomor HP</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                {{-- <a type="button" class="btn btn-secondary" data-dismiss="modal">Batal</a> --}}
                <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    @include('client._components.footer')
@endsection