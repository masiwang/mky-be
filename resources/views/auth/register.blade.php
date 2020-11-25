<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <title>Hello, world!</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body, html{
            font-family: 'Nunito', sans-serif;
            height: 100%;
            font-size: .9275rem;
            line-height: 1.5;
            /* font-weight: 500 */
        }
    </style>
</head>

<body class="d-flex align-items-center bg-auth" style="border-top: 3px solid #28a745">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 offset-xl-2 offset-md-1 order-md-2 mb-5 mb-md-2">
                <img src="/happiness.svg" alt="" srcset="">
            </div>
            <div class="col-12 col-md-5 col-xl-4 order-md-1 my-5">
                <h1 class="text-center mb-2" style="font-weight: 600">Sign up</h1>
                <p class="text-center text-secondary mb-5">Yuk makmurkan petani Indonesia!</p>
                <form action="{{ url('register') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="exampleFormControlInput1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="nama@makarya.in">
                        @if (\Session::has('email'))
                            <small class="text-danger">{{ \Session::get('email') }}</small>
                        @endif
                    </div>
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-6">
                                Password
                            </div>
                        </div>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password Anda">
                    </div>
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-6">
                                Ulangi Password
                            </div>
                        </div>
                        <input type="password" name="password_confirm" class="form-control" id="passwordConfirm" placeholder="Masukkan password Anda sekali lagi">
                        @if (\Session::has('password'))
                            <small class="text-danger">{{ \Session::get('password') }}</small>
                        @endif
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-success w-100 py-2 rounded-lg">Sign up</button>
                    </div>
                    <p class="text-center text-secondary">Suah punya akun? <a href="{{ url('login') }}" class="text-success text-decoration-none">Masuk langsung beli atau investasi</a></p>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>
</body>

</html>
