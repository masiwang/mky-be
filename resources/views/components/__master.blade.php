<!doctype html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="_token" content="{{ csrf_token() }}">
      <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
      <link rel="shortcut icon" type="image/jpg" href="{{ asset('image/logo.ico')}}"/>
      <link href="https://fonts.googleapis.com/css2?family=Hind:wght@400;500;600;700&display=swap" rel="stylesheet"> 
      <title>@yield('title') - Makarya</title>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
      <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
      <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
      <style>
        body, html{
          overflow-x: hidden
        }
        .spinner {
          margin: 10px auto 0;
          width: 70px;
          text-align: center;
        }

        .spinner > div {
          width: 18px;
          height: 18px;
          background-color: #333;

          border-radius: 100%;
          display: inline-block;
          -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
          animation: sk-bouncedelay 1.4s infinite ease-in-out both;
        }

        .spinner .bounce1 {
          -webkit-animation-delay: -0.32s;
          animation-delay: -0.32s;
        }

        .spinner .bounce2 {
          -webkit-animation-delay: -0.16s;
          animation-delay: -0.16s;
        }

        @-webkit-keyframes sk-bouncedelay {
          0%, 80%, 100% { -webkit-transform: scale(0) }
          40% { -webkit-transform: scale(1.0) }
        }

        @keyframes sk-bouncedelay {
          0%, 80%, 100% { 
            -webkit-transform: scale(0);
            transform: scale(0);
          } 40% { 
            -webkit-transform: scale(1.0);
            transform: scale(1.0);
          }
        }
        body, html{
            font-family: 'Hind', sans-serif;
        }
        .card-title {
            font-size: 1rem;
            font-weight: 200;
            text-transform: uppercase
        }

        .product-title a {
            color: #333;
        }

        .product-title a:hover {
            color: #28a745;
        }

        .footer-link {
            padding-left: 0px;
        }

        .footer-link a {
            color: #bbb;
        }

        .footer-link a:hover {
            color: #fff;
        }

        .footer-link li {
            list-style-type: none;
            padding: .8rem 0;
        }

        .top-slide-list {
            padding-left: 0
        }

        .sidemenu ul {
            padding-left: .5rem;
            list-style-type: none;
        }

        .sidemenu-link {
            text-decoration: none;
            color: #333;
        }

        .sidemenu-link:hover {
            color: #28a745
        }

        .ma-link {
            padding: .5rem 1rem 2rem .5rem;
            color: #333;
            text-decoration: none;
            margin: 1rem
        }

        .ma-link:hover {
            color: #28a745
        }

        .ma-link.active {
            color: #28a745
        }

        .getting-started-disable {
            pointer-events: none;
        }

        .getting-started-disable span {
            background: #6c757d !important;
        }

        .getting-started-disable p {
            color: #6c757d !important;
        }

        .card-product {
            border: 0px;
        }

        .card-product hr {
            margin: 5px 0;
        }

        .card-img-top {
            height: 180px;
        }

        @media only screen and (max-width: 768px) {
            .card-product__image-container {
                height: calc(50vw - 12px);
            }
        }
      </style>
      <style>
        .spinner2 {
          width: 40px;
          height: 40px;
          margin: 100px auto;
          background-color: #333;

          border-radius: 100%;  
          -webkit-animation: sk-scaleout2 1.0s infinite ease-in-out;
          animation: sk-scaleout2 1.0s infinite ease-in-out;
        }

        @-webkit-keyframes sk-scaleout2 {
          0% { -webkit-transform: scale(0) }
          100% {
            -webkit-transform: scale(1.0);
            opacity: 0;
          }
        }

        @keyframes sk-scaleout2 {
          0% { 
            -webkit-transform: scale(0);
            transform: scale(0);
          } 100% {
            -webkit-transform: scale(1.0);
            transform: scale(1.0);
            opacity: 0;
          }
        }
      </style>
      @yield('top-script')
    </head>
    <body style="background-color: whitesmoke">
      @yield('content')
      @yield('bottom-script')
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    </body>
</html>