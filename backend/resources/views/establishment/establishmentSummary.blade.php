@extends('layout.layout_registration')

@section('title', 'Establishment Admin Form')

@section('content')

<section id="establishmentSummary">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 text-center">
                <h1 class="mt-3">COVID-19 Contact Tracing Libmanan</h1>
                <h3 class="form_sub_title_registration">Step 4 of 4 : Summary</h3>
            </div>
        </div>

        {{-- <div class="jumbotron bg-light mt-4">
            <h1 class="display-4 text-success"><i class="fas fa-check-circle"></i> Successfully Registered</h1>
            <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
            <hr class="my-4">
            <a class="btn btn-primary btn-lg" href="/" role="button">Go to Home</a>
            <a class="btn btn-primary btn-lg" href="/" role="button">Go to Home</a>
        </div> --}}

        {{-- <div class="row justify-content-center mt-2 mb-5">
            <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12 col-12 form-columns">

                <h2 class="">Verification Code</h2>
                <p>We've sent a verification code on your phone number +639XXXXXXXXX  </br> Please enter the verification code below.</p>
                

                <form action="">
                    <input type="text" class="form-control mb-3" id="verification_code" aria-describedby="verification_code" placeholder="123456">
                    
                    <a href="/establishment/summary" class="btn btn-primary btn-block">Next</a>
                    <a href="#" class="btn btn-secondary btn-block">Resend Code</a>
                </form>

            </div>
        </div> --}}

        <div class="row justify-content-center mt-2 mb-5">
            <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12 col-12 form-columns">

                <h2 class="text-success"><i class="fas fa-check-circle"></i> Successfully Registered</h2>
                <p class="m-0">You've successfully register on Libmanan Contact Tracing App.</p>
                <p class="m-0">You can now login to the mobile scanner app, use your mobile number that is you've used during the registration.</p>
                <p>Thank you.</p>
                <hr class="my-4">
                <a class="btn btn-primary btn-lg btn-block" href="/" role="button">Go to Home</a>
                <a class="btn btn-secondary btn-lg btn-block" href="#" role="button">About Scanner</a>

                

            </div>
        </div>


    </div>
</section>
    
@endsection