@extends('layouts.layout_tracking')

@section('title', ' Citizen Tracking')
    

@section('content')
    
<section id="citizen">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-xl-12 text-center">
                <h1 class="mt-3">COVID-19 Contact Tracing Libmanan</h1>
                <h3 class="form_sub_title_registration">Citizen Check-in</h3>
            </div>


            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-11 col-12 track-columns  mt-3 mb-5">


                <div class="alert alert-primary" role="alert">
                    Note :  It requires your phone number used to register in Libmanan Contact Tracing for authentication.
                </div>
                <h3>Phone number</h3>
                
                <p>Start tracking your check in, enter your phone number below used during the registration.</p>
                <form>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-lg" id="number" aria-describedby="emailHelp" placeholder="e.g (09514292787)">
                    </div>
                    <a href="/citizen/tracking/authentication" type="submit"  class="btn btn-primary btn-lg">Next</a>
                </form>
            </div>

        </div>

    </div>
    
</section>

@endsection