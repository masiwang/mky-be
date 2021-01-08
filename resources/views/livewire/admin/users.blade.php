<div class="container" style="margin-top: 6rem">
  <div class="row">
    <div class="col-2 p-2">
      <ul class="list-group  mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <input wire:model="query" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Cari...">
        </li>
      </ul>
      <p class="mb-1" style="font-weight: 500">Pilih user</p>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="select('all')" type="button" class="text-decoration-none">
            Semua {{ $select_by == 'all' ? '👈' : ''}}
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="select('verified')" type="button" class="text-decoration-none">
            Verified {{ $select_by == 'verified' ? '👈' : ''}}
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="select('new')" type="button" class="text-decoration-none">
            Baru {{ $select_by == 'new' ? '👈' : ''}}
          </a>
        </li>
      </ul>
      <p class="mb-1" style="font-weight: 500">Urutkan berdasarkan</p>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="orderBy('name')" type="button" class="text-decoration-none">
            Nama {{ $order_by == 'name' ? '👈' : ''}}
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="orderBy('created_at')" type="button" class="text-decoration-none">
            Waktu Daftar {{ $order_by == 'created_at' ? '👈' : ''}}
          </a>
        </li>
        {{-- <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="orderBy('new')" type="button" class="text-decoration-none">
            Baru {{ $select_by == 'new' ? '👈' : ''}}
          </a>
        </li> --}}
      </ul>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="orderTo('asc')" type="button" class="text-decoration-none">
            A - Z {{ $order_to == 'asc' ? '👈' : ''}}
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="orderTo('desc')" type="button" class="text-decoration-none">
            Z - A {{ $order_to == 'desc' ? '👈' : ''}}
          </a>
        </li>
      </ul>
    </div>
    <div class="col-10 p-2">
      <div class="row">
        @foreach ($users as $user)
        <div class="col-3 mb-3">
          <div class="card">
            <a href="/v2/admin/user/{{ $user->id }}">
              <div style="height: 10rem; background-image: url({{ $user->image ?? 'https://i.stack.imgur.com/l60Hf.png' }}); background-size: cover; background-repeat: no-repeat; background-position: center"></div>
            </a>
            <div class="card-body">
              <a href="/v2/admin/user/{{ $user->id }}" class="text-secondary mb-0">{{ $user->email }}</a><br/>
              <a href="/v2/admin/user/{{ $user->id }}" style="font-size: 1rem; color: var(--bs-green); font-weight: 500">{{ $user->name ?? '-' }}</a>
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
</div>