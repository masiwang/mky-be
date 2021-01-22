<div>
  @livewire('client.component.navbar')
  <div class="container" style="margin-top: 5rem">
    <div class="row">
      <div class="col-xl-2 d-none d-xl-block">
        <p class="mb-1 fw-bolder">Statistik Anda</p>
        <ul class="list-group mb-3">
          <li class="list-group-item">
            <div>Total Modal</div>
            <h6>Rp. {{ number_format($total_modal, 2, ',', '.') }}</h6>
          </li>
          <li class="list-group-item">
            <div>Total portofolio</div>
            <h6>{{ $total_portofolio }} portofolio</h6>
          </li>
          <li class="list-group-item">
            <div>Total Pendapatan</div>
            <h6 class="text-success mb-1">Rp. {{ number_format($total_pendapatan, 2, ',', '.') }} ({{ number_format(($total_pendapatan/$total_modal)*100, 2) }}%)</h6>
          </li>
        </ul>
        <p class="mb-1 fw-bolder">Status portofolio</p>
        <ul class="list-group mb-3">
          <li class="list-group-item {{ $status == 'all' ? 'bg-success text-white' : '' }}">
            <a type="button" wire:click="$set('status', 'all')">Semua</a>
          </li>
          <li class="list-group-item {{ $status == 'ongoing' ? 'bg-success text-white' : '' }}">
            <a type="button" wire:click="$set('status', 'ongoing')">Berjalan</a>
          </li>
          <li class="list-group-item {{ $status == 'done' ? 'bg-success text-white' : '' }}">
            <a type="button" wire:click="$set('status', 'done')">Selesai</a>
          </li>
        </ul>
      </div>
      <div class="col-xl-10">
        <div class="d-block d-xl-none mb-4 border p-3 rounded">
          <h5 class="mb-1">Statistik Anda</h5>
          <div class="row">
            <div class="col-4">
              <span>Total Modal</span>
              <p class="fw-bolder">Rp. {{ number_format($total_modal, 2, ',', '.') }}</p>
            </div>
            <div class="col-4">
              <span>Total Portofolio</span>
              <p class="fw-bolder">{{ $total_portofolio }} portofolio</p>
            </div>
            <div class="col-4">
              <span>Total pendapatan</span>
              <p class="text-success mb-1 fw-bolder">Rp. {{ number_format($total_pendapatan, 2, ',', '.') }} ({{ number_format(($total_pendapatan/$total_modal)*100, 2) }}%)</p>
            </div>
          </div>
        </div>
        <div class="row">
          @foreach ($portofolios as $portofolio)
          <div class="col-xl-3 col-6 mb-3">
            <div class="card">
              <a href="/pendanaan/{{ $portofolio->product->id }}">
                <div style="height: 10rem; background-image: url({{ $portofolio->product->image }}); background-size: cover; background-repeat: no-repeat; background-position: center"></div>
              </a>
              <div class="card-body">
                <a href="/mitra/{{ $portofolio->product->vendor->id }}" class="text-secondary mb-0">{{ $portofolio->product->vendor->name }}</a><br/>
                <a href="/pendanaan/{{ $portofolio->product->id }}" style="font-size: 1.1rem; color: var(--bs-green); font-weight: 500">{{ $portofolio->product->name }}</a>
                <table>
                  <tr data-bs-toggle="tooltip" title="Invoice">
                    <td>📃</td>
                    <td>{{ $portofolio->invoice }}</td>
                  </tr>
                  <tr data-bs-toggle="tooltip" title="Modal">
                    <td>💵</td>
                    <td>Rp {{ number_format($portofolio->qty * $portofolio->product->price, 2, ',', '.') }}</td>
                  </tr>
                  <tr>
                    <td>⏱</td>
                    <td>{{ date('d M', strtotime($portofolio->product->started_at)) }} - {{ date('d M Y', strtotime($portofolio->product->ended_at)) }}</td>
                  </tr>
                  <tr data-bs-toggle="tooltip" title="Bagi hasil">
                    <td>📈</td>
                    @if($portofolio->product->actual_return)
                    <td class="text-success">Rp {{ number_format($portofolio->qty * $portofolio->product->price * ($portofolio->product->actual_return/100)) }} ({{ $portofolio->product->actual_return }}%)</td>
                    @else
                    <td>Belum selesai</td>
                    @endif
                  </tr>
                </table>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <div class="d-flex justify-content-center">
          <button type="button" wire:click="more" class="btn btn-success mb-5">Lebih banyak</button>
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
        <span>Status portofolio</span>
        <select wire:model="status" class="form-select mb-2" aria-label="Default select example">
          <option value="all">Semua</option>
          <option value="ongoing">Berjalan</option>
          <option value="end">Selesai</option>
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
