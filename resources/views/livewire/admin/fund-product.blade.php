<div class="container" style="margin-top: 6rem">
  <form wire:submit.prevent="update" class="row">
    <div class="col-2">
      @if ($product->image)
      <img src="{{ $product->image }}" class="mb-2" style="max-width: 100%">
      @else
      <div class="bg-gray" style="height: 4rem; width: 100%">&nbsp;</div>
      @endif
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a href="/markas/fund/{{ $product->id }}" class="text-decoration-none">
            Detail {{$view == 'detail' ? '👁' : ''}}
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="$set('view', 'report')" type="button" class="text-decoration-none">
            Laporan {{$view == 'report' ? '👁' : ''}}
          </a>
          <span class="badge bg-success rounded-pill">0</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="$set('view', 'investor')" type="button" class="text-decoration-none">
            Investor {{$view == 'investor' ? '👁' : ''}}
          </a>
          <span class="badge bg-success rounded-pill">{{ count($portofolios) }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a href="/markas/vendor/{{ $product->vendor->id }}" class="text-decoration-none">
            Vendor
          </a>
        </li>
      </ul>
      <button type="button" wire:click="exportInvestors" class="btn btn-primary w-100 mb-4">Export investor (xlsx)</button>
      @if($view == 'detail')
      <div class="mb-3">
        <div class="mb-3">
          <label for="formFile" class="form-label">Ubah gambar produk</label>
          <input wire:model="product_image" class="form-control" type="file" id="formFile">
        </div>
        <button wire:loading.remove wire:target="product_image" type="submit" class="btn btn-success w-100 mb-1">Simpan</button>
        <button wire:loading wire:target="product_image" class="btn btn-outline-success w-100 mb-1">Loading...</button>
        <button type="button" class="btn btn-danger w-100">Hapus produk</button>
      </div>
      @endif
    </div>
    <div class="col-10">
      @if($view == 'detail')
      <div class="w-100 p-2">
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Nama produk</label>
          <div class="col-sm-10">
            <input wire:model="product_name" type="text" class="form-control">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Nama mitra</label>
          <div class="col-sm-10">
            <select wire:model="product_vendor_id" class="form-select" aria-label="Default select example">
              <option selected>Open this select menu</option>
              @foreach ($vendors as $vendor)
              @if ($product_vendor_id == $vendor->id)
              <option value="{{ $vendor->id }}" selected>{{ $vendor->name }}</option>
              @else
              <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>    
              @endif
              @endforeach
            </select>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Kategory</label>
          <div class="col-sm-10">
            <select wire:model="product_category_id" class="form-select" aria-label="Default select example">
              <option>Pilih..</option>
              <option value="1" {{ $product_category_id == 1 ? 'selected' : '' }}>Pertanian</option>
              <option value="2" {{ $product_category_id == 2 ? 'selected' : '' }}>Peternakan</option>
              <option value="3" {{ $product_category_id == 3 ? 'selected' : '' }}>Perikanan</option>
            </select>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Harga</label>
          <div class="col-sm-10">
            <div class="input-group">
              <span class="input-group-text" id="basic-addon1">Rp</span>
              <input wire:model="product_price" type="number" class="form-control" aria-describedby="basic-addon1">
              <span class="input-group-text">per paket</span>
            </div>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Total stok</label>
          <div class="col-sm-10">
            <div class="input-group">
              <input wire:model="product_total_stock" type="number" class="form-control" aria-describedby="basic-addon1">
              <span class="input-group-text">paket</span>
            </div>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Sisa stok</label>
          <div class="col-sm-10">
            <div class="input-group">
              <input wire:model="product_current_stock" type="number" class="form-control" aria-describedby="basic-addon1">
              <span class="input-group-text">paket</span>
            </div>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Est. Imbal hasil</label>
          <div class="col-sm-10">
            <div class="input-group">
              <input wire:model="product_estimated_return" type="text" class="form-control" aria-describedby="basic-addon1">
              <span class="input-group-text">%</span>
            </div>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Imbal Hasil Aktual</label>
          <div class="col-sm-10">
            <div class="input-group">
              <input wire:model="product_actual_return" type="number" step="0.1" class="form-control" aria-describedby="basic-addon1">
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
                  <input wire:model="product_started_at" id="startedat" class="form-control"/>
                  <script>
                    $("#startedat").flatpickr();
                  </script>
                </div>
              </div>
              <div class="col-6">
                <div class="input-group">
                  <span class="input-group-text">Tanggal Penutupan</span>
                  <input wire:model="product_ended_at" id="endedat" class="form-control"/>
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
            <input wire:model="product_prospectus" type="text" class="form-control" aria-describedby="basic-addon1">
            </div>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Deskripsi</label>
          <div class="col-sm-10">
            <textarea wire:model="product_description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
        </div>
      </div>
      @endif

      @if($view == 'investor')
      @if(Session::has('error'))
      <div class="alert alert-danger" role="alert">
        {{ Session::get('error') }}
      </div>
      @endif
      <div class="row">
        @foreach ($portofolios as $portofolio)
        <div class="col-3 mb-3">
          <div class="card h-100" style="position: relative">
            <a href="/markas/user/{{ $portofolio->user->id }}">
              <div style="height: 10rem; background-image: url({{ $portofolio->user->image ?? 'https://i.stack.imgur.com/l60Hf.png' }}); background-size: cover; background-repeat: no-repeat; background-position: center"></div>
            </a>
            <div class="d-flex flex-row w-100 p-2" style="position: absolute; left: 0; top: 0;">
              @if(!($portofolio->invoice_sent_at))
              <button wire:click="sendInvoice({{$portofolio->id}})" type="button" class="btn btn-sm py-2 mr-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kirim invoice">📜</button>
              @endif
              @if(!$portofolio->return_sent_at)
              <button wire:click="sendReturn({{$portofolio->id}})" type="button" class="btn btn-sm py-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kirim return">💰</button>
              @endif
              <div class="flex-fill"></div>
              <button class="btn py-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus investor">❌</button>
            </div>
            <div class="card-body">
              <a href="/markas/user/{{ $portofolio->user->id }}" class="text-secondary mb-0" style="font-size: .8rem">{{ $portofolio->user->email }}</a><br/>
              <a href="/markas/user/{{ $portofolio->user->id }}" style="font-size: 1rem; color: var(--bs-green); font-weight: 500">{{ $portofolio->user->name ?? '-' }}</a>
              <table>
                <tr>
                  <td>Fak</td>
                  <td>
                    {{ $portofolio->id }} // {{ $portofolio->user->id }} // {{ $portofolio->product->id }}
                  </td>
                </tr>
                <tr>
                  <td>🏛</td>
                  <td style="font-size: .8rem">{{ $portofolio->user->bank_type ?? '-' }} {{ $portofolio->user->bank_acc ?? '-' }}</td>
                </tr>
                <tr>
                  <td>💰</td>
                  <td>{{ number_format($portofolio->qty) }} paket</td>
                </tr>
                <tr>
                  <td>📈</td>
                  <td>Rp {{ number_format($portofolio->product->price * $portofolio->qty, 2) }}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        @endforeach
        <div class="col-3 mb-3">
          <div class="card h-100">
            <a href="">
              <div style="height: 10rem; background-image: url({{ 'https://i.stack.imgur.com/l60Hf.png' }}); background-size: cover; background-repeat: no-repeat; background-position: center"></div>
            </a>
            <div class="card-body">
              <div class="mb-1">
                <input wire:model="new_investor_name" type="text" class="form-control form-control-sm" placeholder="Cari nama" list="userList"/>
                <datalist id="userList">
                  @foreach($users as $user)
                  <option value="{{ $user->name }}">
                  @endforeach
                </datalist>
              </div>
              <div>
                <input wire:model="new_investor_qty" type="number" class="form-control form-control-sm mb-2" placeholder="Jumlah paket"/>
              </div>
              <div>
                <button wire:click="addNewInvestor" type="button" class="w-100 btn btn-success">
                 <span wire:loading.remove wire:target="addNewInvestor">Tambah investor</span>
                 <span wire:loading wire:target="addNewInvestor">Loading...</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-end mb-4">
        <button wire:click="moreInvestor" class="btn btn-success" type="button">Lebih banyak</button>
      </div>
      @endif
    </div>
    <div wire:loading wire:target="sendInvoice, sendReturn">
      <div class="d-flex flex-column justify-content-center align-items-center" style="position:fixed; top: 0; left: 0; height: 100vh; width: 100vw; background-color: #333333bb">
        <img src="https://steamuserimages-a.akamaihd.net/ugc/499143799328359714/EE0470B9BD25872DC95E7973B2C2F7006B7B9FB8/" alt="" style="height: 2rem">
        <p class="text-white">Loading...</p>
      </div>
    </div>
  </form>
</div>