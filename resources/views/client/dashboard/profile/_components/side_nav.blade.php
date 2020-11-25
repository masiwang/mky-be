<div class="row p-3">
    <div class="col-md-4">
        @if($user->image)
        <img src="{{ asset($user->image) }}" class="w-100" alt="" srcset="">
        @else
        <img src="/image/assets/product-default.png" class="w-100" alt="" srcset="">
        @endif
        
    </div>
    <div class="col-md-8 d-flex align-items-center text-nowrap">
        <a href="" class="text-decoration-none text-secondary font-weight-bold">{{ $user->name }}</a>
    </div>
</div>
<div class="row sidemenu">
    <div class="col-md-12 p-4">
        <div class="d-flex justify-content-between">
            <h6>Profil Saya</h6>
            <a style="color: #333" role ="button" data-toggle="collapse" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-down-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                </svg>
            </a>
        </div>
        <div class="collapse show" id="collapseExample">
            <ul class="side-list">
                <li><a href="{{ url('/profile') }}" class="sidemenu-link active">Biodata Diri</a></li>
                <li><a href="{{ url('/profile/address') }}" class="sidemenu-link">Daftar Alamat</a></li>
                <li><a href="{{ url('/profile/security') }}" class="sidemenu-link">Keamanan</a></li>
            </ul>
        </div> 
        <div class="d-flex justify-content-between">
            <h6>Pembelian</h6>
            <a style="color: #333" role ="button" data-toggle="collapse" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-down-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                </svg>
            </a>
        </div>
        <div class="collapse show" id="collapseExample2">
            <ul>
                <li><a href="" class="sidemenu-link">Daftar Transaksi</a></li>
                <li><a href="" class="sidemenu-link">Menunggu Pembayaran</a></li>
                <li><a href="" class="sidemenu-link">Cek Pengiriman</a></li>
            </ul>
        </div>
        <div class="d-flex justify-content-between">
            <h6>Pendanaan</h6>
            <a style="color: #333" role ="button" data-toggle="collapse" data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-down-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                </svg>
            </a>
        </div>
        <div class="collapse show" id="collapseExample3">
            <ul>
                <li><a href="{{ url('/profile/fund') }}" class="sidemenu-link">Semua</a></li>
                <li><a href="{{ url('/profile/fund') }}?status=wait" class="sidemenu-link">Menunggu Pembayaran</a></li>
                <li><a href="{{ url('/profile/fund') }}?status=funding" class="sidemenu-link">Dalam Pembiayaan</a></li>
                <li><a href="{{ url('/profile/fund') }}?status=done" class="sidemenu-link">Selesai</a></li>
            </ul>
        </div>
    </div>
</div>