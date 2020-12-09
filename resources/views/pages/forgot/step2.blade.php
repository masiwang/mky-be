<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <title>Lupa Password - Makarya</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body, html{
      font-family: 'Nunito', sans-serif;
      height: 100%;
      font-size: .9275rem;
      line-height: 1.5;
    }
  </style>
</head>

<body class="d-flex align-items-center bg-auth" style="border-top: 3px solid #28a745">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-6 offset-xl-2 offset-md-1 order-md-2 mb-5 mb-md-2 d-flex align-items-center">
        <img src="/images/happiness.svg" alt="" srcset="" style="width: 100%">
      </div>
      <div class="col-12 col-md-5 col-xl-4 order-md-1 my-5">
        <h1 class="text-center mb-2" style="font-weight: 600">Lupa password</h1>
        <p class="text-center text-secondary mb-5">Yuk makmurkan petani Indonesia!</p>

        <form action="{{url('/forgot/reset')}}" method="POST">
          @csrf
          <div class="mb-4">
            <label for="exampleFormControlInput1" class="form-label">Token</label>
            <input type="text" name="token" class="form-control" id="exampleFormControlInput1">
          </div>
          <div class="mb-4">
            <label for="exampleFormControlInput2" class="form-label">Password</label>
            <input type="password" name="new_password" class="form-control" id="exampleFormControlInput2">
          </div>
          <div class="mb-4">
            <label for="exampleFormControlInput3" class="form-label">Konfirmasi Password</label>
            <input type="password" name="new_password_confirm" class="form-control" id="exampleFormControlInput3">
          </div>
          {{-- Jika terdapat error --}}
          @if( Session::has('error') )
            <div class="mb-2">
              <span class="text-danger">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-exclamation-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                </svg> {{ \Session::get('error')}}
              </span>
            </div>
          @endif

          <div class="mb-3">
            <button class="btn btn-success w-100 py-2 rounded-lg">Ubah Password</button>
          </div>
          <p class="text-center text-secondary">Belum punya akun? <a href="{{ url('register') }}" class="text-success text-decoration-none">Daftar sekarang juga</a></p>
        </form>
      </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>
</html>