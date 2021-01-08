<div class="container" style="margin-top: 6rem">
  <div class="row">
    <div class="col-2 p-2">
      <ul class="list-group  mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <input wire:model="search" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Cari...">
        </li>
      </ul>
      <p class="mb-1" style="font-weight: 500">Urutkan berdasarkan</p>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="$set('order_by', 'name')" type="button" class="text-decoration-none">
            Nama {{ $order_by == 'name' ? '👈' : ''}}
          </a>
        </li>
        {{-- <li class="list-group-item d-flex justify-content-between align-items-center">
          <a  wire:click="$set('order_by', 'name')"  type="button" class="text-decoration-none">
            Waktu Daftar {{ $order_by == 'created_at' ? '👈' : ''}}
          </a>
        </li> --}}
      </ul>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="$set('order_to', 'asc')" type="button" class="text-decoration-none">
            A - Z {{ $order_to == 'asc' ? '👈' : ''}}
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="$set('order_to', 'desc')"  type="button" class="text-decoration-none">
            Z - A {{ $order_to == 'desc' ? '👈' : ''}}
          </a>
        </li>
      </ul>
    </div>
    <div class="col-10 p-2">
      <div class="row">
        @foreach ($vendors as $vendor)
        <div class="col-3 mb-3">
          <div class="card h-100">
            <a href="/v2/admin/vendor/{{ $vendor->id }}">
              <div style="height: 10rem; background-image: url({{ $vendor->image ?? 'https://i.stack.imgur.com/l60Hf.png' }}); background-size: cover; background-repeat: no-repeat; background-position: center"></div>
            </a>
            <div class="card-body">
              <a href="/v2/admin/vendor/{{ $vendor->id }}" class="text-secondary mb-0">{{ $vendor->owner }}</a><br/>
              <a href="/v2/admin/vendor/{{ $vendor->id }}" style="font-size: 1rem; color: var(--bs-green); font-weight: 500">{{ $vendor->name ?? '-' }}</a>
              <table>
                <tr>
                  <td>🏛</td>
                  <td style="font-size: .8rem">{{ $vendor->bank_type ?? '-' }} {{ $vendor->bank_acc ?? '-' }}</td>
                </tr>
                <tr>
                  <td>☎️</td>
                  <td>{{ $vendor->phone }}</td>
                </tr>
                <tr>
                  <td>📈</td>
                  <td>Rp {{ number_format($vendor->investasi, 2) }}</td>
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