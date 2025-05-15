@extends('layouts.layout_common')

@section('title', ' I-Card')

@section('js-import')
<script src="{{ asset('js/citizen/icard-v.js') }}"></script>
@endsection
    

@section('content')
    
<section id="id-verification">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12 text-center">
                <h1 class="mt-3">COVID-19 Contact Tracing Libmanan</h1>
                <h3 class="form_sub_title_registration">Citizen Download I-Card</h3>
            </div>
            
            
        </div>

        <div class="row justify-content-center mt-2 mb-5">
            <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12 col-12 track-columns">
                <h2 class="">Verification Code</h2>
                <div class="alert alert-danger d-none" id="codeI">
                    <strong>Error! </strong>Invalid verification code.
                </div>
                
                @if (session('id_d_number'))
                    <p class="mb-0">We've sent a verification code on your phone number 
                    <span>{{session('id_d_number')}}</span>
                </br> Please enter the verification code below.</p>
                @endif

                <a href="/citizen/i-card">Change phone number</a>

                <form method="POST" enctype="multipart/form-data" id="id_verify" action="javascript:void(0)">
                    @csrf
                    <div class="form-group">
                        <input type="number" class="form-control form-control-lg" id="id_code" name="id_code" max="6" placeholder="XXXXXX">
                        <div id="mobileA" class="invalid-feedback">Please fill the field with the verification code we've sent.</div>
                    </div>
                </form>

                <button type="submit" id="next-submit-v" class="btn btn-primary btn-block">NEXT</button>
                <button id="resend-v" class="btn btn-block" disabled>Resend Code</button>

            </div>
        </div>
    </div>
    
</section>

@endsection