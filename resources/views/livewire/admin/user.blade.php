<div class="container" style="margin-top: 6rem">
  @if(Session::has('success'))
  <div class="mb-3">
    <div class="alert alert-primary" role="alert">
      {{ Session::get('success') }}
    </div>
  </div>
  @endif
  @if(Session::has('error'))
  <div class="mb-3">
    <div class="alert alert-danger" role="alert">
      {{ Session::get('error') }}
    </div>
  </div>
  @endif
  <div class="row">
    <div class="col-2 p-2">
      <div class="mb-3" style="height: 10rem; background-image: url({{ $user->image ?? 'https://i.stack.imgur.com/l60Hf.png' }}); background-size: cover; background-repeat: no-repeat; background-position: center"></div>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a type="button" wire:click="$set('view', 'profile')" class="text-decoration-none">
            Profile {{ $view == 'profile' ? '👁' : ''}}
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a type="button" wire:click="$set('view', 'portofolio')" class="text-decoration-none">
            Portofolio {{ $view == 'portofolio' ? '👁' : ''}}
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a type="button" wire:click="$set('view', 'transaction')" class="text-decoration-none">
            Transaksi {{ $view == 'transaction' ? '👁' : ''}}
          </a>
        </li>
      </ul>
      @if( !$user->ktp_verified_at )
      <p class="mb-1" style="font-weight: 500">Konfirmasi user</p>
      <div class="mb-3">
        <button wire:click="confirm" type="button" class="btn btn-success w-100 mb-3">
          <span wire:loading wire:target="confirm">Loading..</span>
          <span wire:loading.remove wire:target="confirm">Konfirmasi</span>
        </button>
        <select wire:model="reject_cause" class="form-select mb-1" aria-label="Default select example">
          <option selected>Pilih jika tolak...</option>
          <option value="1">Email tidak valid</option>
          <option value="2">Identitas tidak valid</option>
        </select>
        <button wire:click="reject" type="button" class="btn btn-danger w-100 mb-3">
          <span wire:loading wire:target="reject">Loading..</span>
          <span wire:loading.remove wire:target="reject">Tolak</span>
        </button>
        @if ($reject_error) <span class="text-danger">Penolakan gagal. Coba lagi.</span> @endif
        <button wire:click="remove" type="button" class="btn btn-dark w-100">Hapus user</button>
        <small class="text-danger">*) data tidak dapat dikembalikan</small>
      </div>
      @endif
    </div>
    @if($view == 'profile')
    <div class="col-10 p-2">
      @if( !$user->ktp_verified_at )
      <div class="mb-3 row">
        <div class="col-6 p-4">
          <p>KTP</p>
          <img src="{{ $user->ktp_image }}" class="w-100" alt="">
        </div>
        <div class="col-6 p-4">
          <p>NPWP</p>
          @if($user->npwp_image)
          <img src="{{ $user->npwp_image }}" class="w-100" alt="">
          @else
          <div class="d-flex justify-content-center align-items-center h-100">
            <span class="mb-3">User tidak upload NPWP</span>
          </div>
          @endif
        </div>
      </div>
      @endif
      <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
          <div class="input-group">
            <input type="text" class="form-control bg-white" disabled aria-describedby="basic-addon1" value="{{ $user->name }}">
          </div>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">ID KTP</label>
        <div class="col-sm-10">
          <div class="input-group">
            <input type="text" class="form-control bg-white" disabled aria-describedby="basic-addon1" value="{{ $user->ktp }}">
          </div>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">ID NPWP</label>
        <div class="col-sm-10">
          <div class="input-group">
            <input type="text" class="form-control bg-white" disabled aria-describedby="basic-addon1" value="{{ $user->npwp }}">
          </div>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <div class="input-group">
            <input type="text" class="form-control bg-white" disabled aria-describedby="basic-addon1" value="{{ $user->email }}">
          </div>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">HP</label>
        <div class="col-sm-10">
          <div class="input-group">
            <input type="text" class="form-control bg-white" disabled aria-describedby="basic-addon1" value="{{ $user->phone }}">
          </div>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Rekening Bank</label>
        <div class="col-sm-10">
          <div class="input-group">
            <input type="text" class="form-control bg-white" disabled aria-describedby="basic-addon1" value="{{ $user->bank_type }} {{ $user->bank_acc }}">
          </div>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Alamat</label>
        <div class="col-sm-10">
          <div class="input-group">
            <input type="text" class="form-control bg-white" disabled aria-describedby="basic-addon1" value="{{ $user->jalan }}, {{ $user->kelurahan }}, {{ $user->kecamatan }}, {{ $user->kabupaten }}, {{ $user->provinsi }} {{ $user->kodepos }}">
          </div>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Pekerjaan</label>
        <div class="col-sm-10">
          <div class="input-group">
            <input type="text" class="form-control bg-white" disabled aria-describedby="basic-addon1" value="{{ $user->job }}">
          </div>
        </div>
      </div>
    </div>
    @endif

    @if($view == 'portofolio')
    <div class="col-10 p-2">
      <div class="row">
        @foreach ($portofolios as $portofolio)
        <div class="col-3 mb-3">
          <div class="card">
            <a href="/markas/fund/{{ $portofolio->product->id }}">
              <div style="height: 10rem; background-image: url({{ $portofolio->product->image ?? '/image/product-default.png' }}); background-size: cover; background-repeat: no-repeat; background-position: center"></div>
            </a>
            <div class="card-body">
              <a href="/markas/vendor/{{ $portofolio->product->vendor->id }}" class="text-secondary mb-0">{{ $portofolio->product->vendor->name }}</a><br/>
              <a href="/markas/fund/{{ $portofolio->product->id }}" style="font-size: 1.1rem; color: var(--bs-green); font-weight: 500">{{ $portofolio->product->name }}</a>
              <table>
                <tr>
                  <td>📃</td>
                  <td>{{ $portofolio->invoice }}</td>
                </tr>
                <tr>
                  <td>⏱</td>
                  <td>{{ date('d M y', strtotime($portofolio->product->started_at)) }} - {{ date('d M y', strtotime($portofolio->product->ended_at)) }}</td>
                </tr>
                <tr>
                  <td>💰</td>
                  <td>Rp {{ number_format($portofolio->product->price * $portofolio->qty, 2) }}</td>
                </tr>
                <tr>
                  <td>📈</td>
                  <td>{{ $portofolio->product->estimated_return }}%</td>
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
    @if($view == 'transaction')
    <div class="col-10 p-2">
      <div class="mb-3 bg-white shadow-sm p-3">
        <div class="row">
          <div class="col-xl-2">
            <span>Jumlah topup</span>
            <h5>Rp {{ number_format($total_topup) }}</h5>
          </div>
          <div class="col-xl-2">
            <span>Jumlah withdraw</span>
            <h5>Rp {{ number_format($total_withdraw * -1) }}</h5>
          </div>
          <div class="col-xl-2">
            <span>Jumlah funding</span>
            <h5>Rp {{ number_format($total_funding * -1) }}</h5>
          </div>
          <div class="col-xl-2">
            <span>Jumlah bagi hasil</span>
            <h5>Rp {{ number_format($total_return) }}</h5>
          </div>
          <div class="col-xl-2">
            <span>Saldo</span>
            <h5>Rp {{ number_format($user->saldo) }}</h5>
          </div>
          <div class="col-xl-2">
            <span>Asset</span>
            <h5>Rp {{ number_format($user->asset) }}</h5>
          </div>
        </div>
      </div>
      <table class="table table-borderless table-hover bg-white">
        <tbody>
          @foreach ($transactions as $transaction)
          <tr>
            <td>
              <div class="row">
                <div class="col-12">
                  <strong style="color: {{ $transaction->type == 'in' ? 'var(--bs-green)' : 'var(--bs-red)'}}">{{ $transaction->code }}</strong>
                  <p class="mb-0"><small>{{ $transaction->user->name }}</small></p>
                </div>
              </div>
            </td>
            <td>
              {{ date('d M Y, H:i:s', strtotime($transaction->created_at)) }}
            </td>
            <td>
              {{ $transaction->type == 'in' ? 'In' : 'Out' }}
            </td>
            <td>
              {{ $transaction->bank_type }} {{ $transaction->bank_acc }}
            </td>
            <td class="{{ $transaction->status_id == 3 }} ? 'text-danger' : '">
              Rp {{ number_format($transaction->nominal, 2) }}
            </td>
            <td>
              <div class="row">
                <div class="col-12">
                  <p class="mb-0" style="color: {{ $transaction->status_id == 3 ? 'var(--bs-red)' : ''}}">{{ $transaction->status->name }}</p>
                  <p class="mb-0"><small>{{ $transaction->updated_at }}</small></p>
                </div>
              </div>
            </td>
            <td>
              <small>{{ $transaction->comment }}</small>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="text-center">
        <button wire:click="morePortofolio" class="btn btn-success" type="button">Lebih banyak</button>
      </div>
    </div>
    @endif
  </div>
  <div wire:loading wire:target="reject, remove">
    <div class="d-flex flex-column justify-content-center align-items-center" style="position:fixed; top: 0; left: 0; height: 100vh; width: 100vw; background-color: #333333bb">
      <img src="https://steamuserimages-a.akamaihd.net/ugc/499143799328359714/EE0470B9BD25872DC95E7973B2C2F7006B7B9FB8/" alt="" style="height: 2rem">
      <p class="text-white">Loading...</p>
    </div>
  </div>
</div>