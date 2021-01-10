<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=.8">
  <link href="/vendors/bootstrap-5.0.0-beta1-dist/css/bootstrap.css" rel="stylesheet" crossorigin="anonymous">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
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
  {{ $slot }}
  @livewireScripts
  <script src="/vendors/bootstrap-5.0.0-beta1-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>