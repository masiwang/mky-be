<div>
  @livewire('client.component.navbar')
  <div class="container mb-5" style="margin-top: 5rem">
    <div class="row">
      <div class="col-xl-2 mb-4">
        <img src="{{ $product->image }}" class="w-100 mb-4" alt="">
        @if(Auth::check())
        <div>
          <p>Sisa stok: <span class="fw-bolder">{{ $product->current_stock }}</span></p>
          <input wire:model="qty" type="number" step="1" class="form-control mb-2" {{ $product->current_stock == 0 ? 'disabled' : '' }} placeholder="Jml. Paket">
          <button class="btn btn-success w-100" type="button" wire:click="$set('confirm_dialog', true)" {{ $product->current_stock == '0' ? 'disabled' : ''}}>
            {{ ( strtotime($product->ended_at) - strtotime(\Carbon\Carbon::now()) < 0 ) ? 'Pendanaan selesai' : ($product->current_stock == 0 ? 'Stok habis' : 'Danai') }}
          </button>
        </div>
        @else
        <a href="/login">Masuk</a> untuk mendanai.
        @endif
        @if(Session::has('error'))
        <span class="text-danger">{{ Session::get('error') }}</span>
        @endif
      </div>
      <div class="col-xl-10">
        <h5 class="fw-normal text-success mb-1">{{ $product->vendor->name }}</h5>
        <h3 class="fw-normal mb-4">{{ $product->name }}</h3>
        <div class="mb-4">
          <span>Harga</span>
          <h5 class="fw-bolder text-success">Rp {{ number_format($product->price, 0, ',', '.') }}/paket</h5>
        </div>
        <div class="mb-4">
          {{ $product->description }}
        </div>
        <div class="mb-4">
          <span>Periode</span>
          <h6>{{ date('d M', strtotime($product->started_at)) }} s/d {{ date('d M Y', strtotime($product->ended_at)) }}</h6>
        </div>
        <div class="mb-4">
          <span>Estimasi Imbal Hasil</span>
          <h6>{{ $product->estimated_return }}%</h6>
        </div>
        <div class="mb-4">
          <span>Imbal Hasil Aktual</span>
          <h6>{{ $product->actual_return ? $product->actual_return.' %' : 'Project belum selesai' }}</h6>
        </div>
        <hr>
        <h3 class="fw-normal mb-4">Prospektus</h3>
        <iframe class="" style="width: 100%; height: 600px" src="{{$product->prospectus}}"></iframe>
      </div>
    </div>
  </div>
  @if($confirm_dialog)
  <div class="d-flex justify-content-center align-items-center" style="height: 100vh; width: 100vw; position: fixed; top: 0; left: 0; background-color: #33333388">
    <div class="card" style="min-width: 20rem">
      <div class="card-body">
        <h6>Apakah Anda yakin?</h6>
      </div>
      <div class="card-footer d-flex justify-content-end">
        <button wire:click="$set('confirm_dialog', false)" class="btn btn-danger" style="width: 5rem">Batal</button>
        &nbsp;
        <button wire:click="fund" class="btn btn-success" style="width: 5rem">Ya</button>
      </div>
    </div>
  </div>
  @endif
  @livewire('client.component.footer')
</div>
