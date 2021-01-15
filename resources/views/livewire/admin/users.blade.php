<div class="container" style="margin-top: 5rem">
  <div class="row">
    <div class="col-xl-2 d-none d-xl-block p-2">
      <input wire:model="query" type="text" class="form-control mb-4" id="exampleFormControlInput1" placeholder="Cari...">
      <p class="mb-1" style="font-weight: 500">Pilih user</p>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="$set('status', 'all')" type="button" class="text-decoration-none">
            Semua {{ $status == 'all' ? '👈' : ''}}
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="$set('status', 'verified')" type="button" class="text-decoration-none">
            Verified {{ $status == 'verified' ? '👈' : ''}}
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
          <a wire:click="$set('order_by', 'name')" type="button" class="text-decoration-none">
            Nama {{ $order_by == 'name' ? '👈' : ''}}
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="$set('order_by', 'created_at')" type="button" class="text-decoration-none">
            Waktu Daftar {{ $order_by == 'created_at' ? '👈' : ''}}
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
    </div>
    <div class="col-xl-10 col-12 p-2 mb-5">
      <input wire:model="query" type="text" class="form-control mb-4 d-xl-none d-block" id="exampleFormControlInput1" placeholder="Cari...">
      <div class="row">
        @foreach ($users as $user)
        <div class="col-xl-3 col-6 mb-3">
          <div class="card h-100">
            <a href="/markas/user/{{ $user->id }}">
              <div style="height: 10rem; background-image: url({{ $user->image ?? 'https://i.stack.imgur.com/l60Hf.png' }}); background-size: cover; background-repeat: no-repeat; background-position: center"></div>
            </a>
            <div class="card-body">
              <a href="/markas/user/{{ $user->id }}" class="text-secondary mb-0">{{ $user->email }}</a><br/>
              <a href="/markas/user/{{ $user->id }}" style="font-size: 1rem; color: var(--bs-green); font-weight: 500">{{ $user->name ?? '-' }}</a>
              <table>
                <tr>
                  <td>🏛</td>
                  <td style="font-size: .8rem">{{ $user->bank_type ?? '-' }} {{ $user->bank_acc ?? '-' }}</td>
                </tr>
                <tr>
                  <td>💰</td>
                  <td>Rp {{ number_format($user->saldo, 2) }}</td>
                </tr>
                <tr>
                  <td>📈</td>
                  <td>Rp {{ number_format($user->asset, 2) }}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="text-center">
        <button wire:click="more" class="btn btn-success" type="button">Lebih banyak</button>
      </div>
    </div>
  </div>
  <div id="fab" class="p-4 d-xl-none d-block" style="position: fixed; bottom: 0; right: 0;">
    <button wire:click="$set('filter', true)" class="btn btn-success p-3 rounded-circle d-flex justify-content-center align-items-center" style="width: 3.5rem; height: 3.5rem">⚙️</button>
  </div>
  @if($filter)
  <div class="d-flex justify-content-center align-items-center" style="height: 100vh; width: 100vw; position: fixed; top: 0; left: 0; background-color: #33333388">
    <div class="card" style="min-width: 20rem">
      <div class="card-body">
        <span>Status user</span>
        <select wire:model="status" class="form-select mb-2" aria-label="Default select example">
          <option value="all">Semua</option>
          <option value="verified">Verified</option>
          <option value="new">Baru</option>
        </select>
        <span>Urutkan berdasarkan</span>
        <select wire:model="order_by" class="form-select" aria-label="Default select example">
          <option value="name">Nama</option>
          <option value="created_at">Waktu daftar</option>
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