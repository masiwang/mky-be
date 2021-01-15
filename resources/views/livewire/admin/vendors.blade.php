<div class="container" style="margin-top: 5rem">
  @if($view == 'index')
  <div class="row">
    <div class="col-xl-2 d-none d-xl-block p-2">
      <input wire:model="search" type="text" class="form-control mb-4" id="exampleFormControlInput1" placeholder="Cari...">
      <p class="mb-1" style="font-weight: 500">Urutkan berdasarkan</p>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a wire:click="$set('order_by', 'name')" type="button" class="text-decoration-none">
            Nama {{ $order_by == 'name' ? '👈' : ''}}
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
          <a wire:click="$set('order_to', 'desc')"  type="button" class="text-decoration-none">
            Z - A {{ $order_to == 'desc' ? '👈' : ''}}
          </a>
        </li>
      </ul>
      <div class="mb-3">
        <button wire:click="$set('view', 'create')" class="w-100 btn btn-success">Mitra Baru</button>
      </div>
    </div>
    <div class="col-xl-10 col-12 p-2 mb-5">
      <input wire:model="search" type="text" class="form-control mb-4 d-block d-xl-none" id="exampleFormControlInput1" placeholder="Cari...">
      <div class="row">
        @foreach ($vendors as $vendor)
        <div class="col-xl-3 col-6 mb-3">
          <div class="card h-100">
            <a href="/markas/vendor/{{ $vendor->id }}">
              <div style="height: 10rem; background-image: url({{ $vendor->image ?? 'https://i.stack.imgur.com/l60Hf.png' }}); background-size: cover; background-repeat: no-repeat; background-position: center"></div>
            </a>
            <div class="card-body">
              <a href="/markas/vendor/{{ $vendor->id }}" class="text-secondary mb-0">{{ $vendor->owner }}</a><br/>
              <a href="/markas/vendor/{{ $vendor->id }}" style="font-size: 1rem; color: var(--bs-green); font-weight: 500">{{ $vendor->name ?? '-' }}</a>
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
  @endif

  @if($view == 'create')
  <form wire:submit.prevent="create" class="row" enctype="multipart/form-data">
    <div class="col-2 p-2">
      @if ($new_vendor_image)
      <img src="{{ $new_vendor_image->temporaryUrl() }}" class="mb-3" style="width: 100%; min-height: 8rem">
      <div class="mb-4">
        <label for="staticEmail" class="form-label">Ubah gambar</label>
        <input wire:model="new_vendor_image" type="file" class="form-control">
      </div>
      @else
      <div class="mb-2 d-flex justify-content-center align-items-center" style="width: 100%; height: 8rem; background-color: #aaa">Upload gambar dulu</div>
      <div class="mb-4">
        <label for="staticEmail" class="form-label">Pilih gambar</label>
        <input wire:model="new_vendor_image" type="file" class="form-control">
      </div>
      @endif
      <div>
        <button type="submit" class="btn btn-success w-100 mb-1">Simpan</button>
        <button type="button" wire:click="$set('view', 'index')" class="btn btn-danger w-100">Batal</button>
      </div>
    </div>
    <div class="col-10">
      {{-- {{ json_encode($new_vendor) }} --}}
      <div class="w-100 p-2">
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Nama Perusahaan</label>
          <div class="col-sm-10">
            <input wire:model="new_vendor.name" type="text" class="form-control">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Nama Pemilik</label>
          <div class="col-sm-10">
            <input wire:model="new_vendor.owner" type="text" class="form-control">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">KTP</label>
          <div class="col-sm-10">
            <input wire:model="new_vendor.ktp" type="text" class="form-control">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">KK</label>
          <div class="col-sm-10">
            <input wire:model="new_vendor.kk" type="text" class="form-control">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">NPWP</label>
          <div class="col-sm-10">
            <input wire:model="new_vendor.npwp" type="text" class="form-control">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Nama Bank</label>
          <div class="col-sm-10">
            <input wire:model="new_vendor.bank_type" type="text" class="form-control">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">No. Rekening</label>
          <div class="col-sm-10">
            <input wire:model="new_vendor.bank_acc" type="text" class="form-control">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input wire:model="new_vendor.email" type="text" class="form-control">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Nomor HP</label>
          <div class="col-sm-10">
            <input wire:model="new_vendor.phone" type="text" class="form-control">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Alamat</label>
          <div class="col-5 mb-2">
            <input wire:model="new_vendor.jalan" type="text" class="form-control" placeholder="Jalan">
          </div>
          <div class="col-2 mb-2">
            <input wire:model="new_vendor.kodepos" type="text" class="form-control" placeholder="Kodepos">
            
          </div>
          <div class="col-3 mb-2">
            <input wire:model="new_vendor.kelurahan" list="kelurahanList" type="text" class="form-control" placeholder="Kelurahan">
            <datalist id="kelurahanList">
              @if($alamats)
              @foreach($alamats as $alamat)
              <option value="{{ $alamat->kelurahan }}">
              @endforeach
              @endif
            </datalist>
          </div>
          <div class="col-2 mb-2">&nbsp;</div>
          <div class="col-3 mb-2">
            <input wire:model="new_vendor.kecamatan" type="text" class="form-control" placeholder="Kecamatan">
          </div>
          <div class="col-3 mb-2">
            <input wire:model="new_vendor.kabupaten" type="text" class="form-control" placeholder="Kabupaten">
          </div>
          <div class="col-4 mb-2">
            <input wire:model="new_vendor.provinsi" type="text" class="form-control" placeholder="Provinsi">
          </div>
        </div>
      </div>
    </div>
  </form>
  @endif
</div>