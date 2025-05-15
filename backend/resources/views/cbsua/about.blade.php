@extends('cbsua.layout')

@section('title', '- Registration Form')

@section('import')
    <!-- <script src="{{ asset('js/cbsua/cbsua.js') }}"></script> -->
@endsection


@section('content')

<!-- <div class="row mt-5">
    <div class="col-xl-12 text-center">
        <h1 class="mt-3">Central Bicol State University Tracing App</h1>
        <h3 class="form_sub_title_registration">Registration Verification</h3>
    </div>
</div> -->
<!-- <div class="container my-5">
    <div class="row mt-y">
        
    </div>
</div> -->
<div class="row ">
    <div class="col">
        <h1 class="mt-5 font-weight-bold about-header" style="color:#174e11! important;">About us</h1>
    </div>
</div>

<div class="row mt-3">
    <div class="col-xl-6 col-lg-6 align-self-center">
        <img src="/images/cbsua/cbsua.jpg" alt="cbsua" class="w-100 ">
    </div>
    <div class="col-xl-6 col-lg-6 align-self-center">
        <div class="card border-0 shadow">
            <div class="card-body">
                <p class="text-justify lead " id="about-school">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                </p>
                <p class="text-justify lead" id="about-school">
                It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row ">
    <div class="col">
        <h1 class="mt-5 font-weight-bold about-header" style="color:#174e11! important;" >Our Team</h1>
    </div>
</div>


<div class="row mt-3">
    <div class="col">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-5 col-md-6 col-10 mb-3">
                        <div class="card border-0 shadow">
                            <img src="/images/cbsua/about1.jpg" class="card-img-top" alt="...">
                            <div class="card-body text-center p-3">
                                <h4 class="font-weight-bold m-0 p-0 about-title">Jay Mark A. Borja</h4>
                                <p class="m-0 p-0 about-sub" >Capstone Developer</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 col-md-6 col-10  mb-3">
                        <div class="card border-0 shadow">
                            <img src="/images/cbsua/about2.jpg" class="card-img-top" alt="...">
                            <div class="card-body text-center p-3">
                                <h4 class="font-weight-bold m-0 p-0 about-title">Dick Harence S. Dela Vega</h4>
                                <p class="m-0 p-0 about-sub">Capstone Adviser</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

