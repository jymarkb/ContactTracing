@extends('layouts.layout_common')

@section('title', ' I-Card')

@section('js-import')
<script src="{{ asset('js/citizen/icard.js') }}"></script>
@endsection
    

@section('content')
    
<section id="id-form">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12 text-center">
                <h1 class="mt-3">COVID-19 Contact Tracing Libmanan</h1>
                <h3 class="form_sub_title_registration">Citizen Download I-Card</h3>
            </div>

            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-11 col-12 track-columns  mt-3 mb-5">
                <div class="alert alert-primary" role="alert">
                    Note :  It requires your mobile number used to register in Libmanan Contact Tracing for authentication.
                </div>
                <h3>Mobile number</h3>
                
                <p>To download your I-Card, enter your mobile number below used during the registration.</p>

                <div class="alert alert-danger d-none" id="mobileI">
                    <strong>Error! </strong>The mobile number you've enter has no identification card registerd.
                </div>

                <form method="POST" enctype="multipart/form-data" id="id_download" action="javascript:void(0)">
                    @csrf
                    <div class="form-group">
                        <input type="number" class="form-control form-control-lg" id="d_number" name="d_number" max="11" placeholder="e.g (09514292787)">
                        <div id="mobileA" class="invalid-feedback">Please fill the field with your 11 digit mobile number (e.g 09XXXXXXXXX)</div>
                    </div>
                </form>
                <button class="btn btn-primary btn-lg" id="next-submit">Next</button>
            </div>

        </div>

    </div>
    
</section>

@endsection