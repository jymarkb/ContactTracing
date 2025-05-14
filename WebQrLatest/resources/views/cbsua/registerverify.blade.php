@extends('cbsua.layout')

@section('title', '- Registration Form')

@section('import')
    <!-- <script src="{{ asset('js/cbsua/cbsua.js') }}"></script> -->
@endsection


@section('content')

<div class="row mt-5">
    <div class="col-xl-12 text-center">
        <h1 class="mt-3" id="titleTop">Central Bicol State University Tracing App</h1>
        <h3 class="form_sub_title_registration">Registration Verification</h3>
    </div>
</div>

<div class="row justify-content-center mt-3">
    <div class="col-xl-6 col-lg-7 col-md-8 col-sm-10">
        <div class="card shadow border-0">
            <div class="card-body p-4 p-md-5">
                <h4 class="">Verification Code</h4>

                @if (session('mobile'))
                    <p class="mb-0" style="font-size:90%;">We've sent a verification code on your phone number 
                    <span>{{session('mobile')}}</span>
                </br> Please enter the verification code below.</p>
                @endif

                <!-- <a href="/reset-number">Change phone number</a> -->

                @if(session()->has('codeInvalid'))
                <div class="alert alert-danger">
                    <strong>Error! </strong>{{session()->get('codeInvalid')}}
                </div>
                @endif


                <form action="/register/postCode" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="number" class="form-control mb-3 verify-form" id="verification_code" name="number" aria-describedby="verification_code" placeholder="XXXXXX" maxlength="6">
                    <!-- <a href="/individual/summary" class="btn btn-primary btn-block">Next</a>
                    <a href="#" class="btn btn-secondary btn-block">Resend Code</a> -->
                    <button type="submit" id="submitCode" class="btn btn-primary btn-lg btn-block">NEXT</button>
                </form>
                <button id="resend" class="btn bt-lg btn-block" disabled>Resend Code</button>


            </div>

            
        </div>
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



@endsection

