<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=.8">
  <link href="/vendors/bootstrap-5.0.0-beta1-dist/css/bootstrap.css" rel="stylesheet" crossorigin="anonymous">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    html, body{
      font-size: .9rem
    }
    th{
      font-weight: 500;
      text-transform: uppercase;
    }
    a{
      color: var(--bs-green-dark);
      text-decoration:none;
    }
    a:hover{
      color: var(--bs-green);
    }
  </style>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  @livewireStyles
</head>
<body class="bg-light">
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-success">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Makarya</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Produk
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/v2/admin/fund">List</a></li>
              <li><a class="dropdown-item" href="/v2/admin/fund-new">Tambah</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="/v2/admin/user">
              User
            </a>
          </li>
          <a class="nav-link" href="/v2/admin/transaction">Traksaksi</a>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Mitra
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/v2/admin/vendor">List</a></li>
              <li><a class="dropdown-item" href="/v2/admin/vendor-new">Baru</a></li>
            </ul>
          </li>
        </div>
      </div>
    </div>
  </nav>
  {{ $slot }}
  @livewireScripts
  <script src="/vendors/bootstrap-5.0.0-beta1-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>