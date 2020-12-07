@extends('components.__master')
@section('title')
  Transaksi
@endsection
@section('content')
@include('components._top_navigation')
  <div class="container mb-5">
    <div class="row my-3">
      <div class="col-12 p-0 shadow-sm mb-4">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
              <a href="{{ url('/') }}">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M6.5 10.995V14.5a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5V11c0-.25-.25-.5-.5-.5H7c-.25 0-.5.25-.5.495z"/>
                  <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                </svg>
              </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
          </ol>
        </nav>
      </div>

      <div class="col-12 bg-white shadow-sm" style="height: 400px; overflow-y: scroll">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Kode Transaksi</th>
              <th>Tipe Transaksi</th>
              <th>Akun Bank</th>
              <th>No Rekening</th>
              <th>Nominal</th>
              <th>Status</th>
              <th>Waktu Konfirmasi</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($transactions as $transaction)
            <tr>
              <td>
                <strong class="{{ $transaction->type == 'in' ? 'text-success' : 'text-danger' }}">
                  {{ $transaction->code }}
                </strong>
              </td>
              <td>{{ ($transaction->type == 'in') ? 'Masuk' : 'Keluar'}}</td>
              <td>{{ $transaction->bank_type }}</td>
              <td>{{ $transaction->bank_acc }}</td>
              <td>Rp {{ number_format($transaction->nominal, 0, ',', '.') }},00</td>
              <td>{{ $transaction->status->name }}</td>
              <td>{{ ($transaction->approved_at) ? date('d M Y - H:m:s', strtotime($transaction->approved_at)) : 'Menunggu' }}</td>
              @if ($transaction->status_id == 3)
                <td class="text-danger">{{ $transaction->comment }}</td>
              @else
                <td>{{ \Str::ucfirst($transaction->comment) }}</td>
              @endif
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@include('components._footer')
@endsection