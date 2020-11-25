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
                        <div class="card h-100 border-0">
                            <div class="card-body table-responsive">
                                <table class="table table-borderless border-top">
                                    <tbody>
                                      <tr class="d-flex flex-row">
                                        <th scope="row">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                        </th>
                                        <td class="flex-fill">
                                            <strong>Rumah Maul</strong><br>
                                            <p>Jl. Pegangsaaan, Sine, Sragen 57261</p>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <span class="btn btn-white" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                                    :
                                                </span>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                            </div>
                            <div class="card-footer border-0 bg-white">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    @include('client._components.footer')
@endsection