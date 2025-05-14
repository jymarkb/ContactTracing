@extends('layout.layout_registration')

@section('title', 'Establishment Admin Form')

@section('content')

<section id="establishmentVerification">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 text-center">
                <h1 class="mt-3">COVID-19 Contact Tracing Libmanan</h1>
                <h3 class="form_sub_title_registration">Step 3 of 4 : Verification</h3>
            </div>
        </div>

        <div class="row justify-content-center mt-2 mb-5">
            <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12 col-12 form-columns">

                <h2 class="">Verification Code</h2>
                <p>We've sent a verification code on your phone number +639XXXXXXXXX  </br> Please enter the verification code below.</p>
                

                <form action="">
                    <input type="text" class="form-control mb-3" id="verification_code" aria-describedby="verification_code" placeholder="123456">
                    
                    <a href="/establishment/summary" class="btn btn-primary btn-block">Next</a>
                    <a href="#" class="btn btn-secondary btn-block">Resend Code</a>
                </form>

            </div>
        </div>
    </div>
</section>
    
@endsection