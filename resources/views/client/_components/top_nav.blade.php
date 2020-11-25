<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="/image/assets/makarya-dark-160x48.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="mr-auto">&nbsp;</div>

            <ul class="navbar-nav mb-2 mb-lg-0">
                {{-- market ditutup dulu --}}
                {{-- <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ url('/market') }}">Market</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ url('/fund') }}">Funding</a>
                </li>
                @if ($user)
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                        Transaksi
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ url('/transaction') }}">Semua Transaksi</a></li>
                        <li><a class="dropdown-item" href="{{ url('/transaction/topup') }}">Tambah dana</a></li>
                        {{-- <li><a class="dropdown-item" href="{{ url('/transaction/withdraw') }}">Tarik dana</a></li> --}}
                    </ul>
                </li>
                @endif
                {{-- <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ url('/notification') }}">Notifikasi</a>
                </li> --}}
                @if ($user)
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
@if (\Auth::user())
<nav class="navbar navbar-expand-lg navbar-dark text-light bg-success shadow-sm d-none d-md-block">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0 mr-auto">
                {{-- market disembunyikan dulu --}}
                {{-- <li class="nav-item">
                    <a class="nav-link" aria-current="page" target="_self" href="{{ url('/wishlist') }}">Wishlist</a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link" aria-current="page" target="_self" href="{{ url('/checkout') }}">Pesanan</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" target="_self" href="{{ url('/portofolio') }}">Portofolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" target="_self" href="{{ url('/help') }}">Bantuan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" target="_self" href="{{ url('/faq') }}">FAQ</a>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li id="saldo" class="nav-item">
                    <a class="nav-link" disabled>Saldo: Rp. {{ $saldo }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@endif
