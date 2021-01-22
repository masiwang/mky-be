<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm fixed-top dark-mode">
  <div class="container-fluid">
    <a class="navbar-brand" href="/pendanaan">
      <img src="/images/makarya-dark-160x48.png" style="height: 32px" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/pendanaan">Pendanaan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/portofolio">Portofolio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/transaksi">Transaksi</a>
        </li>
      </ul>
      @if(Auth::user())
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item d-flex align-items-center">
          <a type="button" wire:click="darkmode">
            @if(Session::has('dark-mode'))
              @if(Session::get('dark-mode') == true)
              <span>🌝 Mode gelap</span>
              @else
              <span>🌞 Mode cerah</span>
              @endif  
            @else
            <span>🌞 Mode cerah</span>
            @endif
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            💰 Rp. {{ number_format($navbar_user->saldo + $navbar_user->asset, 2, ',', '.') }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end border-0 bg-light" aria-labelledby="navbarDropdown">
            <li>
              <a class="dropdown-item" href="#">
                <small class="text-secondary">Saldo</small><br/><span>Rp. {{number_format($navbar_user->saldo, 2, ',', '.')}}</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="#">
                <small class="text-secondary">Asset <span class="text-success" style="font-size: .6rem;">[Portofolio berjalan]</span></small><br/><span>Rp. {{number_format($navbar_user->asset, 2, ',', '.')}}</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/notifikasi">📧 <sup class="text-danger fw-bolder">{{ $navbar_notification }}</sup></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            🧑 Profil
          </a>
          <ul class="dropdown-menu dropdown-menu-end border-0 bg-light" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/profile">Profil Saya</a></li>
            <li><a type="button" wire:click="logout" class="dropdown-item">Keluar</a></li>
          </ul>
        </li>
      </ul>
      @else
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/login">Masuk</a>
        </li>
      </ul>
      @endif
    </div>
  </div>
</nav>
