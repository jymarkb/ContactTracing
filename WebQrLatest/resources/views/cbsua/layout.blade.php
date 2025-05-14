<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>CBSUA - Tracing App @yield('title')</title>

        <!-- Scripts -->
        <!-- <script src="{{ asset('js/app.js') }}"></script> -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
        <script src="https://kit.fontawesome.com/62f0a2e296.js" crossorigin="anonymous"></script>

        <!-- Fonts -->
        <link rel = "icon" href = "{{asset('images/cbsua/cbsua.png')}}" type = "image/x-icon">

        <!-- Styles -->
        <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
        <link href="{{ asset('css/cbsua/cbsua.css') }}" rel="stylesheet">
        @yield('import')


    </head>

    <body class="">

    <div class="content d-flex flex-column min-vh-100" >
        <nav class="navbar fixed-top navbar-expand-lg bg-new-nav navbar-dark static-top shadow">
            <div class="container">
                <a class="navbar-brand" style="line-height:30px;" href="/">
                    <img src="{{asset('images/cbsua/cbsua.png')}}" width="30px" height="30px"  class="d-inline-block align-top" alt="">
                    CBSUA - Tracing App
                </a>
                <button id="btnTop" class="btn btn-link d-lg-none rounded-circle  border border-white" name="btnTop" data-toggle="collapse" data-target="#navbarResponsive">
                    <i class="text-white fa fa-bars "></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Home</a>
                        </li>
                        <li class="nav-item {{ Request::is('register/*') ? 'active' : '' }}">
                            <a class="nav-link" href="/register/eula">Register</a>
                        </li>
                        <li class="nav-item {{ Request::is('about/*') ? 'active' : '' }}">
                            <a class="nav-link" href="/about/developer">About</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <section class="section mt-5">

            <div class="container my-5">
                @yield('content')
            </div>

            
            
        </section>

        <footer class="mt-auto bg-dark">
            <div class="container p-1">
                <div class="row">
                    <div class="col-12 text-center text-white">
                        <p class="m-0 p-1 small"><span>Copyright &copy; CBSUA Tracing App - 2021 By : <a href="https://web.facebook.com/mackyhoho"> Jay Mark A. Borja</a></span></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    </body>

    
  
</html>
