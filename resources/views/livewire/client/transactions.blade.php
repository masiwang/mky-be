<div>
  @livewire('client.component.navbar')
  <div class="container" style="margin-top: 5rem">
    <div class="row">
      <div class="col-xl-2 d-none d-xl-block">
        <button class="btn btn-success mb-1 w-100" type="button" wire:click="openTopup">Tambah Saldo</button>
        <button class="btn btn-danger mb-4 w-100" type="button" wire:click="openWithdraw">Tarik Saldo</button>
        <input type="text" class="form-control mb-4" placeholder="Cari...">
        <p class="mb-1 fw-bolder">Tipe transaksi</p>
        <ul class="list-group mb-3">
          <li class="list-group-item">
            <a type="button" wire:click="$set('type', 'all')">Semua {{ $type == 'all' ? '👈' : '' }}</a>
          </li>
          <li class="list-group-item">
            <a type="button" wire:click="$set('type', 'in')">Debit {{ $type == 'in' ? '👈' : '' }}</a>
          </li>
          <li class="list-group-item">
            <a type="button" wire:click="$set('type', 'out')">Kredit {{ $type == 'out' ? '👈' : '' }}</a>
          </li>
        </ul>
        <p class="mb-1 fw-bolder">Urutkan berdasarkan</p>
        <ul class="list-group mb-3">
          <li class="list-group-item">
            <a type="button" wire:click="$set('order_by', 'nominal')">Nominal {{ $order_by == 'nominal' ? '👈' : '' }}</a>
          </li>
          <li class="list-group-item">
            <a type="button" wire:click="$set('order_by', 'id')">Tanggal transaksi {{ $order_by == 'id' ? '👈' : '' }}</a>
          </li>
        </ul>
        <p class="mb-1 fw-bolder">Urutkan secara</p>
        <ul class="list-group mb-3">
          <li class="list-group-item">
            <a type="button" wire:click="$set('order_to', 'asc')">A-Z {{ $order_to == 'asc' ? '👈' : '' }}</a>
          </li>
          <li class="list-group-item">
            <a type="button" wire:click="$set('order_to', 'desc')">Z-A {{ $order_to == 'desc' ? '👈' : '' }}</a>
          </li>
        </ul>
      </div>
      <div class="col-xl-10">
        <table class="table table-hover d-none d-xl-block">
          @foreach ($transactions as $transaction)
          <tr>
            <td>
              <div class="row">
                <div class="col-12">
                  <small>{{ date('d M Y, H:i:s', strtotime($transaction->created_at)) }}</small><br/>
                  <a wire:click="openDetail({{ $transaction->id }})" class="mb-0 text-bold" type="button" style="color: {{ $transaction->type == 'in' ? 'var(--bs-green)' : 'var(--bs-red)'}}">{{ $transaction->code }}</a><br/>
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
                  <p class="mb-0" style="color: {{ $transaction->status_id == 3 ? 'var(--bs-red)' : ($transaction->status_id == 1 ? 'var(--bs-secondary)' : 'var(--bs-success)')}}">{{ $transaction->status->name }}</p>
                  <p class="mb-0"><small>{{ $transaction->updated_at }}</small></p>
                </div>
              </div>
            </td>
            <td><small>{{ $transaction->comment }}</small></td>
          </tr>
          @endforeach
        </table>
        <input type="text" class="form-control mb-4 d-block d-xl-none" placeholder="Cari...">
        <table class="table table-hover d-block d-xl-none">
          @foreach ($transactions as $transaction)
          <tr>
            <td>
              <div class="row">
                <div class="col-12">
                  <small>{{ date('d M Y, H:i:s', strtotime($transaction->created_at)) }}</small><br/>
                  <a wire:click="openDetail({{ $transaction->id }})" class="mb-0 text-bold" type="button" style="color: {{ $transaction->type == 'in' ? 'var(--bs-green)' : 'var(--bs-red)'}}">{{ $transaction->code }}</a><br/>
                  <small>{{ $transaction->bank_type }} {{ $transaction->bank_acc }}</small>
                </div>
              </div>
            </td>
            <td class="{{ $transaction->status_id == 3 }} ? 'text-danger' : '">
              Rp {{ number_format($transaction->nominal, 2) }}
            </td>
            <td>
              <p class="mb-0" style="color: {{ $transaction->status_id == 3 ? 'var(--bs-red)' : ($transaction->status_id == 1 ? 'var(--bs-secondary)' : 'var(--bs-success)')}}">{{ $transaction->status->name }}</p>
              <small>{{ $transaction->comment }}</small>
            </td>
          </tr>
          @endforeach
        </table>
        <div class="d-flex justify-content-center mb-5">
          <button class="btn btn-success" type="button" wire:click="more">Lebih banyak</button>
        </div>
      </div>
    </div>
  </div>
  <div id="fab" class="p-4 d-xl-none d-block" style="position: fixed; bottom: 0; right: 0;">
    <button wire:click="openTopup" class="btn btn-light p-3 rounded-circle d-flex justify-content-center align-items-center mb-2" style="width: 3.5rem; height: 3.5rem">➕</button>
    <button wire:click="openWithdraw" class="btn btn-danger p-3 rounded-circle d-flex justify-content-center align-items-center mb-2" style="width: 3.5rem; height: 3.5rem">➖</button>
    <button wire:click="$set('filter', true)" class="btn btn-success p-3 rounded-circle d-flex justify-content-center align-items-center" style="width: 3.5rem; height: 3.5rem">⚙️</button>
  </div>
  @if($dialog)
      <div style="position: fixed; top: 0; left: 0; background-color: #33333366; width: 100vw; height: 100vh" class="d-flex justify-content-center align-items-center">
        <form wire:submit.prevent="submit" class="card" style="width: 20rem">
          <div class="card-body">
            <h6 class="card-title">{{ $dialog_type == 'topup' ? 'Tambah' : 'Tarik' }} saldo</h6>
            <hr>
            <div class="mb-2">
              <input type="text" wire:model="bank_type" class="form-control" placeholder="Nama bank">
            </div>
            <div class="mb-2">
              <input type="text" wire:model="bank_acc" class="form-control" placeholder="No. Rekening">
            </div>
            <div class="mb-2">
              <input type="number" wire:model="nominal" class="form-control" placeholder="Nominal">
            </div>
            @if($dialog_type == 'topup')
            <div class="mb-2">
              <span>Bukti transfer <span class="text-info">Max. 2Mb</span></span>
              <input type="file" wire:model="image" class="form-control" accept=".jpg,.jpeg,.png">
            </div>
            @endif
            @if(Session::has('error'))
            {{ Session::get('error') }}
            @endif
          </div>
          <div class="card-footer w-100 d-flex justify-content-end">
            <button wire:click="$set('dialog', false)" type="button" class="btn btn-light btn-sm">Tutup</button>&nbsp;
            <button type="submit" class="btn btn-success btn-sm">
              <span wire:loading wire:target="image">Loading...</span>
              <span wire:loading.remove wire:target="image">Simpan</span>
            </button>
          </div>
        </form>
      </div>
  @endif
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
        <span>Urutkan berdasarkan</span>
        <select wire:model="order_by" class="form-select mb-2" aria-label="Default select example">
          <option value="nominal">Semua</option>
          <option value="created_at">Baru</option>
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
  @livewire('client.component.footer')
</div>
