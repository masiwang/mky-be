<div class="container" style="margin-top: 6rem">
  <div class="row">
    <div class="col-2 p-2">
      <div class="mb-3" style="height: 10rem; background-image: url({{ $vendor->image ?? 'https://i.stack.imgur.com/l60Hf.png' }}); background-size: cover; background-repeat: no-repeat; background-position: center"></div>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a type="button" wire:click="$set('view', 'profile')" class="text-decoration-none">
            Profile {{ $view == 'profile' ? '👁' : ''}}
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a type="button" wire:click="$set('view', 'product')" class="text-decoration-none">
            Produk Pendanaan {{ $view == 'product' ? '👁' : ''}}
          </a>
        </li>
      </ul>
    </div>
    @if($view == 'profile')
    <div class="col-10 p-2">
      <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Nama perusahaan</label>
        <div class="col-sm-10">
          <div class="input-group">
            <input type="text" class="form-control bg-white" disabled aria-describedby="basic-addon1" value="{{ $vendor->name }}">
          </div>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Nama Pemilik</label>
        <div class="col-sm-10">
          <div class="input-group">
            <input type="text" class="form-control bg-white" disabled aria-describedby="basic-addon1" value="{{ $vendor->owner }}">
          </div>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">ID KTP</label>
        <div class="col-sm-10">
          <div class="input-group">
            <input type="text" class="form-control bg-white" disabled aria-describedby="basic-addon1" value="{{ $vendor->ktp }}">
          </div>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">ID KK</label>
        <div class="col-sm-10">
          <div class="input-group">
            <input type="text" class="form-control bg-white" disabled aria-describedby="basic-addon1" value="{{ $vendor->kk }}">
          </div>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">ID NPWP</label>
        <div class="col-sm-10">
          <div class="input-group">
            <input type="text" class="form-control bg-white" disabled aria-describedby="basic-addon1" value="{{ $vendor->npwp }}">
          </div>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <div class="input-group">
            <input type="text" class="form-control bg-white" disabled aria-describedby="basic-addon1" value="{{ $vendor->email }}">
          </div>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">HP</label>
        <div class="col-sm-10">
          <div class="input-group">
            <input type="text" class="form-control bg-white" disabled aria-describedby="basic-addon1" value="{{ $vendor->phone }}">
          </div>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Rekening Bank</label>
        <div class="col-sm-10">
          <div class="input-group">
            <input type="text" class="form-control bg-white" disabled aria-describedby="basic-addon1" value="{{ $vendor->bank_type }} {{ $vendor->bank_acc }}">
          </div>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Alamat</label>
        <div class="col-sm-10">
          <div class="input-group">
            <input type="text" class="form-control bg-white" disabled aria-describedby="basic-addon1" value="{{ $vendor->jalan }}, {{ $vendor->kelurahan }}, {{ $vendor->kecamatan }}, {{ $vendor->kabupaten }}, {{ $vendor->provinsi }} {{ $vendor->kodepos }}">
          </div>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Total investasi</label>
        <div class="col-sm-10">
          <div class="input-group">
            <input type="text" class="form-control bg-white" disabled aria-describedby="basic-addon1" value="Rp {{ number_format($vendor->investasi, 2) }}">
          </div>
        </div>
      </div>
    </div>
    @endif

    @if($view == 'product')
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
                  <td>Rp {{ number_format($product->price * $product->total_stock) }}</td>
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
        <button wire:click="morePortofolio" class="btn btn-success" type="button">Lebih banyak</button>
      </div>
    </div>
    @endif
  </div>
</div>