<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=.8">
  <link href="/vendors/bootstrap-5.0.0-beta1-dist/css/bootstrap.css" rel="stylesheet" crossorigin="anonymous">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $title }} | Makarya</title>
  <link rel="shortcut icon" type="image/jpg" href="/images/favicon.ico"/>
  <link href="/styles/index.css" rel="stylesheet" crossorigin="anonymous">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
  <script src="/vendors/OneSignal/popup.js"></script>
  @if(Session::has('dark-mode'))
    @if(Session::get('dark-mode') == true)
    <style>
      body, html{
        background-color: #111!important;
        color: #ccc!important
      }
      .nav-link{
        color: #888!important
      }
      .bg-light{
        background-color: #111!important
      }
      .dropdown-item{
        color: #ccc!important
      }
      .dropdown-item:hover{
        color: #333!important;
        background-color: #ccc
      }
      .card-body{
        background-color:#111!important
      }
      .list-group-item{
        background-color: #222!important
      }
      small{
        color: #ccc!important
      }
      td{
        color: #ccc!important
      }
      .form-control{
        background-color: #ccc
      }
    </style>
    @endif
  @endif
  @livewireStyles
</head>
<body class="bg-light">
  {{ $slot }}
  @livewireScripts
  <script src="/vendors/bootstrap-5.0.0-beta1-dist/js/bootstrap.bundle.min.js"></script>
  <script>
    window.addEventListener('reload', event => {
      location.reload();
    })
    </script>
</body>
</html>