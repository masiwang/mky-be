<div>
  @livewire('client.component.navbar')
  <div class="container mb-5" style="margin-top: 5rem">
    <form wire:submit.prevent="update" class="row">
      <div class="col-xl-2 d-none d-xl-block">
        @if($user->image)
        <div class="mb-3" style="height: 12rem; background-image: url({{ $user->image }}); background-size: cover; background-position: center"></div>
        @else
        <div class="bg-secondary d-flex justify-content-center align-items-center mb-3">
          Belum ada foto
        </div>
        @endif
        <p class="mb-1 fw-bolder">Ubah foto</p>
        <input wire:model="user_image" type="file" class="form-control mb-4" accept=".jpg,.jpeg,.png">
        <button wire:loading.remove wire:target="user_image" type="submit" class="btn btn-success w-100 mb-1">Simpan profile</button>
        <a class="btn btn-danger w-100 mb-4" href="/profile">Batal</a>
      </div>
      <div class="col-xl-8">
        <div class="mb-4 d-flex justify-content-center d-xl-none d-block">
          <div class="mb-3" style="height: 12rem; width: 12rem; background-image: url({{ $user->image }}); background-size: cover; background-position: center"></div>
        </div>
        <div class="row">
          <div class="col-xl-12 mb-4 d-none d-xl-block">
            <h4>{{ $user_name }}</h4>
          </div>
          <div class="col-12 mb-2 d-block d-xl-none">
            <label class="form-label">Ubah foto</label>
            <input wire:model="user_image" type="file" class="form-control w-100" accept=".jpg,.jpeg,.png">
          </div>
          <div class="col-xl-6 mb-3">
            <label class="form-label">Nama</label>
            <input type="text" wire:model="user_name" class="form-control">
          </div>
          <div class="col-xl-6 mb-3">
            <label class="form-label">No. HP</label>
            <input type="text" wire:model="user_phone" class="form-control">
          </div>
          <div class="col-xl-6 mb-3">
            <label class="form-label">Email</label>
            <input type="text" wire:model="user_email" class="form-control">
          </div>
          <div class="col-xl-6 mb-3">
            <label class="form-label">Pekerjaan</label>
            <input type="text" wire:model="user_job" class="form-control">
          </div>
          <div class="col-xl-4 mb-3">
            <label class="form-label">Nama Bank</label>
            <input type="text" wire:model="user_bank_type" class="form-control">
          </div>
          <div class="col-xl-8 mb-3">
            <label class="form-label">Nomor Rekening bank</label>
            <input type="text" wire:model="user_bank_acc" class="form-control">
          </div>
          <div class="col-xl-6 mb-3">
            <label class="form-label">Jalan</label>
            <input type="text" wire:model="user_jalan" class="form-control">
          </div>
          <div class="col-xl-3 mb-3">
            <label class="form-label">Kodepos</label>
            <input type="text" wire:model="user_kodepos" class="form-control">
          </div>
          <div class="col-xl-3 mb-3">
            <label class="form-label">Kelurahan</label>
            <input type="text" wire:model="user_kelurahan" class="form-control">
          </div>
          <div class="col-xl-4 mb-3">
            <label class="form-label">Kecamatan</label>
            <input type="text" wire:model="user_kecamatan" class="form-control">
          </div>
          <div class="col-xl-4 mb-3">
            <label class="form-label">Kabupaten</label>
            <input type="text" wire:model="user_kabupaten" class="form-control">
          </div>
          <div class="col-xl-4 mb-3">
            <label class="form-label">Provinsi</label>
            <input type="text" wire:model="user_provinsi" class="form-control">
          </div>
          <div class="col-12 d-block d-xl-none">
            <button wire:loading.remove wire:target="user_image" type="submit" class="btn btn-success w-100 mb-1">Simpan profile</button>
          </div>
        </div>
      </div>
      <div class="col-xl-2 d-none d-xl-block">
        <p class="mb-1 fw-bolder">Menu cepat</p>
        <ul class="list-group">
          <li class="list-group-item">
            <a href="/portofolio">Portofolio</a>
          </li>
          <li class="list-group-item">
            <a href="/transaksi">Transaksi</a>
          </li>
        </ul>
      </div>
    </form>
  </div>
  @livewire('client.component.footer')
</div>
