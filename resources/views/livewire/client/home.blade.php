<div>
  @livewire('client.component.navbar')
  <div class="container" style="margin-top: 5rem">
    <div class="row">
      <div class="col-xl-2 d-none d-xl-block">
        <input wire:model.debounce.500ms="search" type="text" class="form-control mb-3" placeholder="Cari...">
        <p class="mb-1 fw-bolder">Kategori produk</p>
        <ul class="list-group mb-3">
          <li class="list-group-item {{ $category == 'all' ? 'bg-success text-white' : '' }}">
            <a type="button" wire:click="$set('category', 'all')">Semua</a>
          </li>
          <li class="list-group-item {{ $category == '1' ? 'bg-success text-white' : '' }}">
            <a type="button" wire:click="$set('category', '1')">Pertanian</a>
          </li>
          <li class="list-group-item {{ $category == '2' ? 'bg-success text-white' : '' }}">
            <a type="button" wire:click="$set('category', '2')">Peternakan</a>
          </li>
          <li class="list-group-item {{ $category == '3' ? 'bg-success text-white' : '' }}">
            <a type="button" wire:click="$set('category', '3')">Perikanan</a>
          </li>
        </ul>
        <p class="mb-1 fw-bolder">Status produk</p>
        <ul class="list-group mb-3">
          <li class="list-group-item {{ $status == 'all' ? 'bg-success text-white' : '' }}">
            <a type="button" wire:click="$set('status', 'all')">Semua</a>
          </li>
          <li class="list-group-item {{ $status == 'new' ? 'bg-success text-white' : '' }}">
            <a type="button" wire:click="$set('status', 'new')">Baru</a>
          </li>
          <li class="list-group-item {{ $status == 'ongoing' ? 'bg-success text-white' : '' }}">
            <a type="button" wire:click="$set('status', 'ongoing')">Berjalan</a>
          </li>
          <li class="list-group-item {{ $status == 'done' ? 'bg-success text-white' : '' }}">
            <a type="button" wire:click="$set('status', 'done')">Selesai</a>
          </li>
        </ul>
        <p class="mb-1 fw-bolder">Urutkan berdasarkan</p>
        <ul class="list-group mb-3">
          <li class="list-group-item {{ $order_by == 'name' ? 'bg-success text-white' : '' }}">
            <a type="button" wire:click="$set('order_by', 'name')">Nama</a>
          </li>
          <li class="list-group-item {{ $order_by == 'ended_at' ? 'bg-success text-white' : '' }}">
            <a type="button" wire:click="$set('order_by', 'ended_at')">Tanggal penutupan</a>
          </li>
        </ul>
        <p class="mb-1 fw-bolder">Urutkan secara</p>
        <ul class="list-group mb-3">
          <li class="list-group-item {{ $order_to == 'asc' ? 'bg-success text-white' : '' }}">
            <a type="button" wire:click="$set('order_to', 'asc')">A-Z</a>
          </li>
          <li class="list-group-item {{ $order_to == 'desc' ? 'bg-success text-white' : '' }}">
            <a type="button" wire:click="$set('order_to', 'desc')">Z-A</a>
          </li>
        </ul>
      </div>
      <div class="col-xl-10">
        <input wire:model.debounce.500ms="search" type="text" class="form-control mb-3 d-block d-xl-none" placeholder="Cari...">
        <div class="row mb-3">
          @foreach ($products as $product)
          <div class="col-xl-3 col-6 mb-3">
            <div class="card shadow-sm">
              <a href="/pendanaan/{{ $product->id }}">
                <div style="height: 10rem; background-image: url({{ $product->image }}); background-size: cover; background-repeat: no-repeat; background-position: center"></div>
              </a>
              <div class="d-flex flex-row w-100 p-2" style="position: absolute; left: 0; top: 0;">
                <div class="flex-fill"></div>
                @if($product->current_stock > 0)
                <span class="badge bg-success">Baru</span>
                @endif
                @if($product->current_stock == 0 and (strtotime($product->ended_at) - strtotime(\Carbon\Carbon::now()) > 0))
                <span class="badge bg-warning">Berjalan</span>
                @endif
                @if(strtotime($product->ended_at) - strtotime(\Carbon\Carbon::now()) < 0)
                <span class="badge bg-primary">Selesai</span>
                @endif
              </div>
              <div class="card-body">
                <a href="/mitra/{{ $product->vendor->id }}" class="text-secondary mb-0">{{ $product->vendor->name }}</a><br/>
                <a href="/pendanaan/{{ $product->id }}" style="font-size: 1.1rem; color: var(--bs-green); font-weight: 500">{{ $product->name }}</a>
                <table>
                  <tr>
                    <td>💵</td>
                    <td>Rp {{ number_format($product->price, 2, ',', '.') }}/paket</td>
                  </tr>
                  <tr>
                    <td>⏱</td>
                    <td>{{ date('d M', strtotime($product->started_at)) }} - {{ date('d M Y', strtotime($product->ended_at)) }}</td>
                  </tr>
                  <tr>
                    <td>📦</td>
                    @if($product->current_stock > 0)
                    <td>{{ $product->current_stock }} paket</td>
                    @else
                    <td>Habis</td>
                    @endif
                  </tr>
                  <tr>
                    <td>📈</td>
                    <td>{{ $product->estimated_return }}%</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <div class="d-flex justify-content-center mb-5">
          <button wire:click="more" class="btn btn-success">Lebih banyak</button>
        </div>
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
        <span>Kategori produk</span>
        <select wire:model="category" class="form-select mb-2" aria-label="Default select example">
          <option value="all">Semua</option>
          <option value="1">Pertanian</option>
          <option value="2">Peternakan</option>
          <option value="3">Perikanan</option>
        </select>
        <span>Status produk</span>
        <select wire:model="status" class="form-select mb-2" aria-label="Default select example">
          <option value="all">Semua</option>
          <option value="new">Baru</option>
          <option value="ongoing">Berjalan</option>
          <option value="done">Selesai</option>
        </select>
        <span>Urutkan berdasarkan</span>
        <select wire:model="order_by" class="form-select" aria-label="Default select example">
          <option value="name">Nama</option>
          <option value="ended_at">Tanggal penutupan</option>
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
  <div wire:loading>
    @php
      $gifs = [
        'https://media.giphy.com/media/kyzzHEoaLAAr9nX4fy/giphy.gif',
        'https://media.giphy.com/media/UsLzFcO1wZCgnAFFvi/giphy.gif',
        'https://media.giphy.com/media/UVqhzNsYWIelUBV7zN/giphy.gif',
        'https://media.giphy.com/media/LPkczVwUYcMbXsRCdP/giphy.gif',
        'https://media.giphy.com/media/UsLzFcO1wZCgnAFFvi/giphy.gif',
        'https://media.giphy.com/media/cNqBzFAC3aU2gDuD4k/giphy.gif',
        'https://media.giphy.com/media/IbaaxVxgaZAZx9ddJ4/giphy.gif'
      ];
      $gif = $gifs[rand(0, 6)];
    @endphp
    <div class="d-flex flex-column justify-content-center align-items-center" style="position:fixed; top: 0; left: 0; height: 100vh; width: 100vw; background-color: #333333bb">
      <img src="{{ $gif }}" alt="" style="height: 6rem">
      <p class="text-white">Sebentar, jangan lupa pakai masker ya...</p>
    </div>
  </div>
  @livewire('client.component.footer')
</div>
