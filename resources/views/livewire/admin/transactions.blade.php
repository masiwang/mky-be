<div class="container" style="margin-top: 6rem">
  <div class="row">
    <div class="col-xl-2 d-none d-xl-block p-2">
      <input wire:model="query" type="text" class="form-control mb-4" id="exampleFormControlInput1" placeholder="Cari kode/nama...">
      <p class="mb-1" style="font-weight: 500">Pilih tipe transaksi</p>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="$set('type', 'all')" type="button" class="text-decoration-none">
            Semua {{ $type == 'all' ? '👈' : ''}}
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="$set('type', 'in')" type="button" class="text-decoration-none">
            Debit {{ $type == 'in' ? '👈' : ''}}
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="$set('type', 'out')" type="button" class="text-decoration-none">
            Kredit {{ $type == 'out' ? '👈' : ''}}
          </a>
        </li>
      </ul>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="$set('status', 'confirmed')" type="button" class="text-decoration-none">
            Terkonfirmasi {{ $status == 'confirmed' ? '👈' : ''}}
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="$set('status', 'new')" type="button" class="text-decoration-none">
            Baru {{ $status == 'new' ? '👈' : ''}}
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
    <div class="col-xl-10 col-12 p-2">
      <input wire:model="query" type="text" class="form-control mb-4 d-block d-xl-none" id="exampleFormControlInput1" placeholder="Cari kode/nama...">
      <table class="table table-borderless table-hover bg-white d-xl-block d-none">
        <tbody>
          @foreach ($transactions as $transaction)
          <tr>
            <td>
              <div class="row">
                <div class="col-12">
                  <small>{{ date('d M Y, H:i:s', strtotime($transaction->created_at)) }}</small><br/>
                  <a wire:click="openDetail({{ $transaction->id }})" class="mb-0 text-bold" type="button" style="color: {{ $transaction->type == 'in' ? 'var(--bs-green)' : 'var(--bs-red)'}}">{{ $transaction->code }}</a><br/>
                  <a href="/markas/user/{{ $transaction->user->id }}" class="mb-0 text-dark"><small>{{ $transaction->user->name }}</small></a>
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
      <table class="table table-borderless table-hover bg-white d-xl-none d-block">
        <tbody>
          @foreach ($transactions as $transaction)
          <tr>
            <td>
              <div class="row">
                <div class="col-12">
                  <small>{{ date('d M Y, H:i:s', strtotime($transaction->created_at)) }}</small><br/>
                  <a wire:click="openDetail({{ $transaction->id }})" class="mb-0 text-bold" type="button" style="color: {{ $transaction->type == 'in' ? 'var(--bs-green)' : 'var(--bs-red)'}}">{{ $transaction->code }}</a><br/>
                  <a href="/markas/user/{{ $transaction->user->id }}" class="mb-0 text-dark"><small>{{ $transaction->user->name }}</small></a>
                </div>
              </div>
            </td>
            <td>
              <p class="mb-0">{{ $transaction->bank_type }} {{ $transaction->bank_acc }}</p>
              <p class="mb-0 {{ $transaction->status_id == 3 }} ? 'text-danger' : '">Rp {{ number_format($transaction->nominal, 2) }}</p>
              <p class="mb-0" style="color: {{ $transaction->status_id == 3 ? 'var(--bs-red)' : ''}}">{{ $transaction->status->name }}</p>
            </td>
            <td><small>{{ $transaction->comment }}</small></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="d-flex justify-content-center">
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
  <div wire:loading wire:target="confirm">
    <div class="d-flex flex-column justify-content-center align-items-center" style="position:fixed; top: 0; left: 0; height: 100vh; width: 100vw; background-color: #333333bb">
      <img src="https://steamuserimages-a.akamaihd.net/ugc/499143799328359714/EE0470B9BD25872DC95E7973B2C2F7006B7B9FB8/" alt="" style="height: 2rem">
      <p class="text-white">Loading...</p>
    </div>
  </div>
  <div id="fab" class="p-4 d-xl-none d-block" style="position: fixed; bottom: 0; right: 0;">
    <button wire:click="$set('new_dialog', true)" class="btn btn-light p-3 rounded-circle d-flex justify-content-center align-items-center mb-2" style="width: 3.5rem; height: 3.5rem">➕</button>
    <button wire:click="$set('delete_dialog', true)" class="btn btn-danger p-3 rounded-circle d-flex justify-content-center align-items-center mb-2" style="width: 3.5rem; height: 3.5rem">➖</button>
    <button wire:click="$set('filter', true)" class="btn btn-success p-3 rounded-circle d-flex justify-content-center align-items-center" style="width: 3.5rem; height: 3.5rem">⚙️</button>
  </div>
  @if($filter)
  <div class="d-flex justify-content-center align-items-center" style="height: 100vh; width: 100vw; position: fixed; top: 0; left: 0; background-color: #33333388">
    <div class="card" style="min-width: 20rem">
      <div class="card-body">
        <span>Tipe transaksi</span>
        <select wire:model="type" class="form-select mb-2" aria-label="Default select example">
          <option value="all">Semua</option>
          <option value="in">Debit</option>
          <option value="out">Kredit</option>
        </select>
        <span>Status Transaksi</span>
        <select wire:model="status" class="form-select" aria-label="Default select example">
          <option value="confirmed">Verified</option>
          <option value="new">Baru</option>
        </select>
        <span>Urutkan berdasarkan</span>
        <select wire:model="order_by" class="form-select" aria-label="Default select example">
          <option value="created_at">Waktu transaksi</option>
        </select>
        <span>Urutkan secara</span>
        <select wire:model="order_to" class="form-select" aria-label="Default select example">
          <option value="asc">A-Z</option>
          <option value="desc">Z-A</option>
        </select>
      </div>
      <div class="card-footer d-flex justify-content-end">
        <button wire:click="$set('filter', false)" class="btn btn-secondary">Tutup</button>
      </div>
    </div>
  </div>
  @endif
</div>