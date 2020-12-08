<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img src="/images/makarya-dark-160x48.png" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <div class="mr-auto">&nbsp;</div>
      <ul class="navbar-nav mb-2 mb-lg-0">
        @if ($user)
          <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
              Transaksi
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="{{ url('/transaction') }}">Transaksi</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="{{ url('/transaction/topup') }}">Tambah saldo</a></li>
              <li><a class="dropdown-item" href="{{ url('/transaction/withdraw') }}">Tarik saldo</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/notification">Notifikasi <strong class="badge bg-danger" style="transform: translateY(-5px)">{{ $user->notification }}</strong></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
              <i class="far fa-user"></i>
              @if ($user->name)
                {{ $user->name }}
              @else
                {{ $user->email }}
              @endif
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="{{ url('profile') }}">Akun</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item" href="{{ url('/portofolio') }}">Portofolio</a>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="{{ url('logout') }}">Keluar</a></li>
            </ul>
        </li>
        @else
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ url('/login') }}">Login</a>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>

@if ($user)
<nav class="navbar navbar-expand-lg navbar-dark text-light bg-success shadow-sm d-none d-md-block">
  <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="mr-auto">&nbsp;</div>
          <ul class="navbar-nav mb-2 mb-lg-0">
              <li id="saldo" class="nav-item">
                  <a class="nav-link" disabled>Saldo: Rp {{ number_format($user->saldo, 0, ',', '.') }}</a>
              </li>
          </ul>
      </div>
  </div>
</nav>
@endif
