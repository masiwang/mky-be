<div class="container" style="margin-top: 6rem">
  <div class="row">
    <div class="col-2 p-2">
      <ul class="list-group  mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <input wire:model="query" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Cari kode/nama...">
        </li>
      </ul>
      <p class="mb-1" style="font-weight: 500">Pilih tipe transaksi</p>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="$set('select_by', 'all')" type="button" class="text-decoration-none">
            Semua {{ $select_by == 'all' ? '👈' : ''}}
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="$set('select_by', 'in')" type="button" class="text-decoration-none">
            Debit {{ $select_by == 'in' ? '👈' : ''}}
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="$set('select_by', 'out')" type="button" class="text-decoration-none">
            Kredit {{ $select_by == 'out' ? '👈' : ''}}
          </a>
        </li>
      </ul>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="$set('filter', 'confirmed')" type="button" class="text-decoration-none">
            Terkonfirmasi {{ $filter == 'confirmed' ? '👈' : ''}}
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="$set('filter', 'new')" type="button" class="text-decoration-none">
            Baru {{ $filter == 'new' ? '👈' : ''}}
          </a>
        </li>
      </ul>
      <p class="mb-1" style="font-weight: 500">Urutkan berdasarkan</p>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="$set('order_by', 'created_at')" type="button" class="text-decoration-none">
            Waktu Transaksi {{ $order_by == 'created_at' ? '👈' : ''}}
          </a>
        </li>
      </ul>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="$set('order_to', 'asc')" type="button" class="text-decoration-none">
            A - Z {{ $order_to == 'asc' ? '👈' : ''}}
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="$set('order_to', 'desc')" type="button" class="text-decoration-none">
            Z - A {{ $order_to == 'desc' ? '👈' : ''}}
          </a>
        </li>
      </ul>
      <div>
        <button wire:click="$set('new_dialog', true)" type="button" class="w-100 btn btn-success mb-1">Transaksi baru</button>
        <button wire:click="$set('delete_dialog', true)" type="button" class="w-100 btn btn-danger">Hapus transaksi</button>
      </div>
    </div>
    <div class="col-10 p-2">
      <table class="table table-borderless table-hover bg-white">
        <tbody>
          @foreach ($transactions as $transaction)
          <tr>
            <td>
              <div class="row">
                <div class="col-12">
                  <small>{{ date('d M Y, H:i:s', strtotime($transaction->created_at)) }}</small><br/>
                  <a wire:click="openDetail({{ $transaction->id }})" class="mb-0 text-bold" type="button" style="color: {{ $transaction->type == 'in' ? 'var(--bs-green)' : 'var(--bs-red)'}}">{{ $transaction->code }}</a><br/>
                  <a href="/v2/admin/user/{{ $transaction->user->id }}" class="mb-0 text-dark"><small>{{ $transaction->user->name }}</small></a>
                </div>
              </div>
            </td>
            <td>
              {{ $transaction->type == 'in' ? 'In' : 'Out' }}
            </td>
            <td>
              {{ $transaction->bank_type }} {{ $transaction->bank_acc }}
            </td>
            <td class="{{ $transaction->status_id == 3 }} ? 'text-danger' : '">
              Rp {{ number_format($transaction->nominal, 2) }}
            </td>
            <td>
              <div class="row">
                <div class="col-12">
                  <p class="mb-0" style="color: {{ $transaction->status_id == 3 ? 'var(--bs-red)' : ''}}">{{ $transaction->status->name }}</p>
                  <p class="mb-0"><small>{{ $transaction->updated_at }}</small></p>
                </div>
              </div>
            </td>
            <td><small>{{ $transaction->comment }}</small></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="d-flex justify-content-end">
        <button wire:click="more" class="btn btn-success" type="button">Lebih banyak</button>
      </div>
      @if($detail_dialog)
      <div style="position: fixed; top: 0; left: 0; background-color: #33333366; width: 100vw; height: 100vh" class="d-flex justify-content-center align-items-center">
        <div class="card" style="width: 20rem">
          <div class="card-body">
            <h6 class="card-title">#{{ $detail_code }}</h6>
              <img src="{{ $detail_image }}" class="w-100" alt="">
          </div>
          <div class="card-footer w-100 d-flex justify-content-end">
            <button wire:click="$set('detail_dialog', false)" class="btn btn-light btn-sm">Tutup</button>&nbsp;
            <button wire:click="confirm" class="btn btn-success btn-sm">Konfirmasi</button>
          </div>
        </div>
      </div>
      @endif
      @if($new_dialog)
      <div style="position: fixed; top: 0; left: 0; background-color: #33333366; width: 100vw; height: 100vh" class="d-flex justify-content-center align-items-center">
        <div class="card" style="width: 20rem">
          <div class="card-body">
            <h6 class="card-title">Transaksi baru</h6>
            <hr>
            <div class="mb-2">
              <input wire:model="new_user" type="text" class="form-control form-control-sm" placeholder="Nama user" list="userList">
              <datalist id="userList">
                {{-- @if($users) --}}
                @foreach ($users as $user)
                <option value="{{ $user->name }}">
                @endforeach
                {{-- @endif --}}
              </datalist>
            </div>
            <div class="mb-2">
              <select wire:model="new_type" class="form-select form-select-sm" aria-label="Default select example">
                <option selected>Pilih tipe pembayaran...</option>
                <option value="1">Topup saldo</option>
                <option value="2">Bayar pendanaan</option>
                <option value="3">Kasih return</option>
                <option value="4">Withdraw saldo</option>
              </select>
            </div>
            @if($new_type == 2 or $new_type == 3)
            <div class="mb-2">
              <select wire:model="new_portofolio" class="form-select form-select-sm" aria-label="Default select example">
                <option selected>Pilih tipe pendanaan...</option>
                @foreach($user->portofolio as $portofolio)
                <option value="{{ $portofolio->id }}">{{ $portofolio->product->name }}</option>
                @endforeach
              </select>
            </div>
            @endif
            @if($new_type == 1 or $new_type == 4)
            <div class="mb-2">
              <input wire:model="new_nominal" type="text" class="form-control form-control-sm" placeholder="Nominal">
            </div>
            @endif
          </div>
          <div class="card-footer w-100 d-flex justify-content-end">
            <button wire:click="$set('new_dialog', false)" class="btn btn-light btn-sm">Tutup</button>&nbsp;
            <button wire:click="save" class="btn btn-success btn-sm">Simpan</button>
          </div>
        </div>
      </div>
      @endif
      @if($delete_dialog)
      <div style="position: fixed; top: 0; left: 0; background-color: #33333366; width: 100vw; height: 100vh" class="d-flex justify-content-center align-items-center">
        <div class="card" style="width: 20rem">
          <div class="card-body">
            <h6 class="card-title">Hapus transaksi</h6>
            <hr>
            <div class="mb-2">
              <input wire:model="delete_code" type="text" class="form-control form-control-sm" placeholder="Kode transaksi">
            </div>
          </div>
          <div class="card-footer w-100 d-flex justify-content-end">
            <button wire:click="$set('delete_dialog', false)" class="btn btn-light btn-sm">Tutup</button>&nbsp;
            <button wire:click="delete" class="btn btn-danger btn-sm">Hapus</button>
          </div>
        </div>
      </div>
      @endif
    </div>
  </div>
</div>