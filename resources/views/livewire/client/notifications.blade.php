<div>
  @livewire('client.component.navbar');
  <div class="container" style="margin-top: 5rem">
    <div class="row">
      <div class="col-xl-2 d-none d-xl-block">
        <input type="text" class="form-control mb-4" wire:model.debounce.500ms="search" placeholder="Cari...">
        <p class="mb-1 fw-bolder">Status notifikasi</p>
        <ul class="list-group mb-3">
          <li class="list-group-item {{ $status == 'all' ? 'bg-success text-white' : '' }}">
            <a type="button" wire:click="$set('status', 'all')">Semua</a>
          </li>
          <li class="list-group-item {{ $status == 'unread' ? 'bg-success text-white' : '' }}">
            <a type="button" wire:click="$set('status', 'unread')">Baru</a>
          </li>
          <li class="list-group-item {{ $status == 'read' ? 'bg-success text-white' : '' }}">
            <a type="button" wire:click="$set('status', 'read')">Sudah dibaca</a>
          </li>
        </ul>
        <p class="mb-1 fw-bolder">Urutkan berdasarkan</p>
        <ul class="list-group mb-3">
          <li class="list-group-item {{ $order_by == 'id' ? 'bg-success text-white' : '' }}">
            <a type="button" wire:click="$set('order_by', 'id')">Waktu diterima</a>
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
        <input type="text" class="form-control w-100 mb-4 d-block d-xl-none" wire:model.debounce.500ms="search" placeholder="Cari...">
        <div class="mb-5 d-none d-xl-block">
          <div class="row">
            <div class="col-xl-3" style="height: 500px; overflow-y: scroll">
              <ul class="list-group list-group-flush">
                @foreach($notifications as $notification)
                <li class="list-group-item">
                  <a type="button" wire:click="view({{ $notification->id }})">
                    <h6 class="mb-1 {{ $notification->status == 'unread' ? 'text-success' : '' }}">{{ Str::substr($notification->title, 0, 20) }}...</h6>
                    <p class="mb-1">{{ $notification->created_at }}</p>
                  </a>
                </li>
                @endforeach
              </ul>
              <button wire:click="more" class="btn btn-success w-100">Lebih banyak</button>
            </div>
            <div class="col-xl-9" style="height: 500px; overflow-y: scroll">
              <div wire:loading wire:target="view">
                <p>Loading...</p>
              </div>
              <div wire:loading.remove wire:target="view">
                @if($notif)
                  <h4>{{ $notif->title }}</h4>
                  <p>{{ $notif->created_at }}</p>
                  <hr>
                  <div>{!! $notif->body !!}</div>
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="mb-5 d-block d-xl-none">
          <div class="row">
            @if(!$detail_view)
            <div class="col-xl-3">
              <ul class="list-group list-group-flush">
                @foreach($notifications as $notification)
                <li class="list-group-item">
                  <a type="button" wire:click="detailView({{ $notification->id }})">
                    <h6 class="mb-1 {{ $notification->status == 'unread' ? 'text-success' : '' }}">{{ $notification->title }}</h6>
                    <p class="mb-1">{{ $notification->created_at }}</p>
                  </a>
                </li>
                @endforeach
              </ul>
              <button wire:click="more" class="btn btn-success w-100">Lebih banyak</button>
            </div>
            @else
            <div class="d-flex justify-content-end">
              <button wire:click="$set('detail_view', false)" class="btn btn-danger">< Kembali</button>
            </div>
            <div wire:loading wire:target="view">
              <p>Loading...</p>
            </div>
            <div wire:loading.remove wire:target="view">
              @if($notif)
                <h4>{{ $notif->title }}</h4>
                <p>{{ $notif->created_at }}</p>
                <hr>
                <div>{!! $notif->body !!}</div>
              @endif
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
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
