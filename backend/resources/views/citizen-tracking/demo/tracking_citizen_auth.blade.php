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

                {{-- <div class="alert alert-primary" role="alert">
                    Note :  It requires your phone number used to register in Libmanan Contact Tracing for authentication.
                </div> --}}
                <h3>Authentication Code</h3>
                
                <p>Please check your phone number, we've send you the six (6) digit authentication code  at (+63)9XX-XXXX-XXX</p>
                <form>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-lg" id="number" aria-describedby="emailHelp" placeholder="e.g (09514292787)">
                    </div>
                    <a href="/citizen/tracking/check-in" type="submit"  class="btn btn-primary btn-lg">Submit</a>
                </form>
            </div>

        </div>

    </div>
    
</section>

@endsection