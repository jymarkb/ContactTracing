@extends('layouts.layout_registration')

@section('title', 'Registration Verification')

@section('content')
    
<section id="verification">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 text-center">
                <h1 class="mt-3">COVID-19 Contact Tracing Libmanan</h1>
                <h3 class="form_sub_title_registration">Step 2 of 3 : Verification</h3>
            </div>
        </div>

        <div class="row justify-content-center mt-2 mb-5">
            <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12 col-12 form-columns">

            <h2 class="">Verification Code</h2>

            @if (session('mobile'))
                <p class="mb-0">We've sent a verification code on your phone number 
                <span>{{session('mobile')}}</span>
            </br> Please enter the verification code below.</p>
            @endif

            <a href="/reset-number">Change phone number</a>

            @if(session()->has('codeInvalid'))
            <div class="alert alert-danger">
                <strong>Error! </strong>{{session()->get('codeInvalid')}}
            </div>
            @endif


                <form action="/postCode" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="number" class="form-control mb-3 " id="verification_code" name="number" aria-describedby="verification_code" placeholder="XXXXXX" maxlength="6">
                    <!-- <a href="/individual/summary" class="btn btn-primary btn-block">Next</a>
                    <a href="#" class="btn btn-secondary btn-block">Resend Code</a> -->
                    <button type="submit" id="submitCode" class="btn btn-primary btn-lg btn-block">NEXT</button>
                </form>
                    <button id="resend" class="btn bt-lg btn-block" disabled>Resend Code</button>

            </div>
        </div>

        <script>
            $(document).ready(function(){
                $('#resend').click(function(){
                $_token = $('meta[name="csrf-token"]').attr('content');
                $sendData = 1;

                $.ajax({
                    url: "/ajaxResend",
                    type:"POST",
                    async:false,
                    data:{
                        resend:$sendData,
                        _token: $_token
                    },
                    success:function(data){
                        if(data == "success"){
                            sessionStorage.setItem("timeleft", 60);
                            downloadTimer = setInterval(timerResend, 1000);
                        }
                    }
                });

                });
                var downloadTimer;
                var valueTimeLeft = sessionStorage.getItem("timeleft");
                function timerResend(){
                valueTimeLeft = sessionStorage.getItem("timeleft");
                if(valueTimeLeft <= 0){
                    clearInterval(downloadTimer);
                    document.getElementById("resend").innerHTML = "Resend Code";
                    document.getElementById("resend").disabled = false;
                } else {
                    document.getElementById("resend").innerHTML = valueTimeLeft + "(s) remaining to re-send code";
                    document.getElementById("resend").disabled = true;
                }
                valueTimeLeft -= 1;
                sessionStorage.setItem("timeleft", valueTimeLeft);
                };

                if(valueTimeLeft != null){
                downloadTimer = setInterval(timerResend, 1000);
                }else{
                valueTimeLeft != null
                document.getElementById("resend").innerHTML = "Resend Code";
                document.getElementById("resend").disabled = false; 
                } 
            });
        </script>
    </div>
</section>  

@endsection