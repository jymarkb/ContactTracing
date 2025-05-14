<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>iSave Libmanan - @yield('title') </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/style.js') }}"></script>
    <script src="{{ asset('js/html2canvas.js') }}"></script>


    <script src="{{ asset('js/FileSaver.js') }}"></script>
    <script src="{{ asset('js/espromise/es6-promise.auto.js') }}"></script>
    <script src="{{ asset('js/espromise/es6-promise.js') }}"></script>
    <script src="{{ asset('js/dom-to-image.js') }}"></script>
    
    @yield('import-js')

    <!-- Fonts -->
    <link rel = "icon" href = "{{asset('images/system/logo.png')}}" type = "image/x-icon"> 

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styleRegistration.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styleRegistrationId.css') }}" rel="stylesheet">
    

</head>
<body>

    <div id="layoutRegister">

        <div class="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light custom-nav sticky-top fix-top" id="navbar">
                <div class="container">
                <a class="navbar-brand mr-2" href="/"><img id="image-logo" style="height: 70px; width:70px;" src="{{asset('images/system/logo.png')}}"></a>
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"><span class="small navbar-toggler-icon "></span></button>
                    <div class="collapse navbar-collapse " id="collapsibleNavbar">
                        <ul class="navbar-nav mr-auto">
                        <li class="nav-item ">
                            <a class="nav-link nav-link-last" href="/" id="nav-home"> Home</a>
                        </li>
                        </ul>
                    </div>
                </div>
            </nav>

        <main class="py-4">
            

            @yield('content')
        </main>


        <section id="footer">
            <div class="container">
                <div class="row pt-5">
                    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-8 col-12">
                        <div class="row mb-3">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <a href="#"> <img src="{{asset('images/system/logo-foot.png')}}" alt=""></a>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 foot-description">
                                <p>This website is for Munifipality of Libmanan Contact Tracing App Registration and advice about coronavirus (COVID-19), how to prevent and protect yourself from disease.</p>
                                <p>Learn about the government response to coronavirus on our social media accounts.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12">
                        <h6 class="foot-link-title">QUICK LINK</h6>
                        <ul class="foot-link-links">
                            <li><a href="#transmission">About Covid</a></li>
                            <li><a href="#symptoms">Symptoms</a></li>
                            <li><a href="#prevent">Prevent</a></li>
                            <li><a href="#note">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                        <h6 class="foot-link-title">HELPFULL LINK</h6>
                        <ul class="foot-link-links">
                            <li><a href="#">Municipality of Libmanan</a></li>
                            <li><a href="#">DOH Covid-19 Tracker</a></li>
                            <li><a href="#">DOH Bicol</a></li>
                            <li><a href="#">DILG Region V</a></li>
                        </ul>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-12">
                        <h6 class="foot-link-title">IMPORTANT LINK</h6>
                        <ul class="foot-link-links">
                            <li><a href="#">WHO Website</a></li>
                            <li><a href="#">DOH Website</a></li>
                            <li><a href="#">DOH CHD Website</a></li>
                            <li><a href="#">IATF Website</a></li>
                        </ul>
                    </div>
                </div>

  

                <div class="row pb-3 footer-last">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <p>© 2020 i-Safe Libmanan. Template Made by <a href="https://www.facebook.com/mackyhoho">Jay Mark A. Borja</a> </p>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 d-flex justify-content-md-end">
                                <a href="#" class="privacy">Privacy Policy</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-justify foot-desclaimer">
                        <p>Disclaimer: We hope you find the information presented on this website useful. This website is for general information and raise awareness of (2019-nCoV) only. If you have any doubt please verify from respective site.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    

    
</body>
</html>