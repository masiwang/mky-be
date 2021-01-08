<div class="container mb-4" style="margin-top: 6rem">
  @if($view == 'list')
  <div class="row">
    <div class="col-2 p-2">
      <ul class="list-group  mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <input wire:model="query" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Cari...">
        </li>
      </ul>
      <p class="mb-1" style="font-weight: 500">Urutkan berdasarkan</p>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a type="button" wire:click="sortBy('name')" class="text-decoration-none">
            Nama produk {{ $sort_by == 'name' ? '👈' : ''}}
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a type="button" wire:click="sortBy('ended_at')" class="text-decoration-none">
            Tgl. Penutupan {{ $sort_by == 'ended_at' ? '👈' : ''}}
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a type="button" wire:click="sortBy('current_stock')" class="text-decoration-none">
            Stok {{ $sort_by == 'current_stock' ? '👈' : ''}}
          </a>
        </li>
      </ul>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a type="button" wire:click="sortTo('asc')" class="text-decoration-none">
            A - Z {{ $sort_to == 'asc' ? '👈' : ''}}
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a type="button" wire:click="sortTo('desc')" class="text-decoration-none">
            Z - A {{ $sort_to == 'desc' ? '👈' : ''}}
          </a>
        </li>
      </ul>
      <div class="mb-3">
        <button wire:click="$set('view', 'add')" class="btn btn-success w-100">Tambah produk</button>
      </div>
    </div>
    <div class="col-10 p-2">
      <div class="row">
        @foreach ($products as $product)
        <div class="col-3 mb-3">
          <div class="card">
            <a href="/v2/admin/fund/{{ $product->id }}">
              <div style="height: 10rem; background-image: url({{ $product->image }}); background-size: cover; background-repeat: no-repeat; background-position: center"></div>
            </a>
            <div class="card-body">
              <a href="/v2/admin/vendor/{{ $product->vendor->id }}" class="text-secondary mb-0">{{ $product->vendor->name }}</a><br/>
              <a href="/v2/admin/fund/{{ $product->id }}" style="font-size: 1.1rem; color: var(--bs-green); font-weight: 500">{{ $product->name }}</a>
              <table>
                <tr>
                  <td>⏱</td>
                  <td>{{ date('d M y', strtotime($product->started_at)) }} - {{ date('d M y', strtotime($product->started_at)) }}</td>
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
      {{ json_encode($product) }}
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
</div>

