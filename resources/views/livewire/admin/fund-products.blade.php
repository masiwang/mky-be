<div class="container mb-4" style="margin-top: 5rem">
  @if($view == 'list')
  <div class="row">
    <div class="col-xl-2 p-2 d-xl-block d-none">
      <input wire:model="query" type="text" class="form-control mb-3" id="exampleFormControlInput1" placeholder="Cari...">
      <p class="mb-1" style="font-weight: 500">Urutkan berdasarkan</p>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a type="button" wire:click="$set('order_by', 'name')" class="text-decoration-none">
            Nama produk {{ $order_by == 'name' ? '👈' : ''}}
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a type="button" wire:click="$set('order_by', 'ended_at')" class="text-decoration-none">
            Tgl. Penutupan {{ $order_by == 'ended_at' ? '👈' : ''}}
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a type="button" wire:click="$set('order_by', 'current_stock')" class="text-decoration-none">
            Stok {{ $order_by == 'current_stock' ? '👈' : ''}}
          </a>
        </li>
      </ul>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a type="button" wire:click="$set('order_to', 'asc')" class="text-decoration-none">
            A - Z {{ $order_to == 'asc' ? '👈' : ''}}
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a type="button" wire:click="$set('order_to', 'asc')" class="text-decoration-none">
            Z - A {{ $order_to == 'desc' ? '👈' : ''}}
          </a>
        </li>
      </ul>
      <div class="mb-3">
        <button wire:click="$set('view', 'add')" class="btn btn-success w-100">Tambah produk</button>
      </div>
    </div>
    <div class="col-xl-10 col-12 p-2">
      <input wire:model="query" type="text" class="form-control mb-4" id="exampleFormControlInput1" placeholder="Cari...">
      <div class="row">
        @foreach ($products as $product)
        <div class="col-xl-3 col-6 mb-3">
          <div class="card h-100">
            <a href="/markas/fund/{{ $product->id }}">
              <div style="height: 10rem; background-image: url({{ $product->image }}); background-size: cover; background-repeat: no-repeat; background-position: center"></div>
            </a>
            <div class="card-body">
              <a href="/markas/vendor/{{ $product->vendor->id }}" class="text-secondary mb-0">{{ $product->vendor->name }}</a><br/>
              <a href="/markas/fund/{{ $product->id }}" style="font-size: 1.1rem; color: var(--bs-green); font-weight: 500">{{ $product->name }}</a>
              <table>
                <tr>
                  <td>⏱</td>
                  <td>{{ date('d M y', strtotime($product->started_at)) }} - {{ date('d M y', strtotime($product->ended_at)) }}</td>
                </tr>
                <tr>
                  <td>💰</td>
                  <td>Rp {{ number_format($product->price * $product->total_stock, 2) }}</td>
                </tr>
                <tr>
                  <td>👨🏻‍💼</td>
                  <td>{{ $product->total_investor }} investor</td>
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
      <div class="text-center">
        <button wire:click="more" class="btn btn-success" type="button">Lebih banyak</button>
      </div>
    </div>
  </div>
  @endif

  @if($view == 'add')
  <form wire:submit.prevent="save" class="row" enctype="multipart/form-data">
    <div class="col-2 p-2">
      @if ($product_image)
      <img src="{{ $product_image->temporaryUrl() }}" class="mb-3" style="width: 100%; min-height: 8rem">
      <div class="mb-4">
        <label for="staticEmail" class="form-label">Ubah gambar</label>
        <input wire:model="product_image" type="file" class="form-control">
      </div>
      @else
      <div class="mb-2 d-flex justify-content-center align-items-center" style="width: 100%; height: 8rem; background-color: #aaa">Upload gambar dulu</div>
      <div class="mb-4">
        <label for="staticEmail" class="form-label">Pilih gambar</label>
        <input wire:model="product_image" type="file" class="form-control">
      </div>
      @endif
      <div>
        <button type="submit" class="btn btn-success w-100 mb-1">Simpan</button>
        <button type="button" wire:click="$set('view', 'list')" class="btn btn-danger w-100">Batal</button>
      </div>
    </div>
    <div class="col-10">
      <div class="w-100 p-2">
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Nama produk</label>
          <div class="col-sm-10">
            <input wire:model="product.name" type="text" class="form-control">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Nama mitra</label>
          <div class="col-sm-10">
            <select wire:model="product.vendor_id" class="form-select" aria-label="Default select example">
              <option selected>Open this select menu</option>
              @foreach ($vendors as $vendor)
              <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Kategory</label>
          <div class="col-sm-10">
            <select wire:model="product.category_id" class="form-select" aria-label="Default select example">
              <option>Pilih..</option>
              <option value="1">Pertanian</option>
              <option value="2">Peternakan</option>
              <option value="3">Perikanan</option>
            </select>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Harga</label>
          <div class="col-sm-10">
            <div class="input-group">
              <span class="input-group-text" id="basic-addon1">Rp</span>
              <input wire:model="product.price" type="number" class="form-control" aria-describedby="basic-addon1">
              <span class="input-group-text">per paket</span>
            </div>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Total stok</label>
          <div class="col-sm-10">
            <div class="input-group">
              <input wire:model="product.total_stock" type="number" class="form-control" aria-describedby="basic-addon1">
              <span class="input-group-text">paket</span>
            </div>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Sisa stok</label>
          <div class="col-sm-10">
            <div class="input-group">
              <input wire:model="product.current_stock" type="number" class="form-control" aria-describedby="basic-addon1">
              <span class="input-group-text">paket</span>
            </div>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Est. Imbal hasil</label>
          <div class="col-sm-10">
            <div class="input-group">
              <input wire:model="product.estimated_return" type="text" class="form-control" aria-describedby="basic-addon1">
              <span class="input-group-text">%</span>
            </div>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Imbal Imbal Hasil</label>
          <div class="col-sm-10">
            <div class="input-group">
              <input wire:model="product.actual_return" type="number" class="form-control" aria-describedby="basic-addon1">
              <span class="input-group-text">%</span>
            </div>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Periode</label>
          <div class="col-sm-10">
            <div class="row">
              <div class="col-6">
                <div class="input-group">
                  <span class="input-group-text">Tanggal Pembukaan</span>
                  <input wire:model="product.started_at" id="startedat" class="form-control"/>
                  <script>
                    $("#startedat").flatpickr();
                  </script>
                </div>
              </div>
              <div class="col-6">
                <div class="input-group">
                  <span class="input-group-text">Tanggal Penutupan</span>
                  <input wire:model="product.ended_at" id="endedat" class="form-control"/>
                  <script>
                    $("#endedat").flatpickr();
                  </script>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Prospektus</label>
          <div class="col-sm-10">
            <div class="input-group">
              <span class="input-group-text">GDrive</span>
            <input wire:model="product.prospectus" type="text" class="form-control" aria-describedby="basic-addon1">
            </div>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Deskripsi</label>
          <div class="col-sm-10">
            <textarea wire:model="product.description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
        </div>
      </div>
    </div>
  </form>
  @endif
  <div id="fab" class="p-4 d-xl-none d-block" style="position: fixed; bottom: 0; right: 0;">
    <button wire:click="$set('filter', true)" class="btn btn-success p-3 rounded-circle d-flex justify-content-center align-items-center" style="width: 3.5rem; height: 3.5rem">⚙️</button>
  </div>
  @if($filter)
  <div class="d-flex justify-content-center align-items-center" style="height: 100vh; width: 100vw; position: fixed; top: 0; left: 0; background-color: #33333388">
    <div class="card" style="min-width: 20rem">
      <div class="card-body">
        <span>Urutkan berdasarkan</span>
        <select wire:model="order_by" class="form-select" aria-label="Default select example">
          <option value="name">Nama</option>
          <option value="ended_at">Tanggal penutupan</option>
          <option value="current_stock">Stok</option>
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

