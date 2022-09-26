<html>

<head>
    <title>Svijet Sporta</title>

    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>

    <style>
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #9C27B0;
            color: white;
            text-align: center;
        }

    </style>

</head>

<body>
    @section('sidebar')

    @show
    <div class="container">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
            <div class="shrink-0 flex items-center">
            <a href="{{ url('/') }}">
                    <img src="{{ asset('img/ikonica.png') }}" height="50px" width="55px" alt="description of myimage"><h3>Svijet Sporta</>
                    </a>
                </div>
            </div>
            <div class="pull-right">
                 <!-- Check user is logged in -->
            @if(\Auth::check())
              <div class='dash'>Korisnik: {{\Auth::user()->name}} ,  <a href="{{url('logout')}}"> ODJAVA</a></div> 
            @else
            <div class='dash '>
              <div class='error'> Niste prijavljeni  </div>
              <div>  <a href="{{url('login')}}">PRIJAVA</a> | <a href="{{url('register')}}">REGISTRACIJA</a> </div>
            </div>
            @endif
           <!-- Check user is logged in --> 
                
            </div>
        </div>
    </div>
    <div class="container">
        @yield('content')
    </div>
</body>

</html>
