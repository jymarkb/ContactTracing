@extends('layouts.layout_common')

@section('title', ' I-Card')

@section('js-import')
<script src="{{ asset('js/citizen/icard-id.js') }}"></script>
@endsection

@section('css-import')
<link href="{{ asset('css/styleRegistrationId.css') }}" rel="stylesheet">
@endsection

@section('content')
    
<div class="row justify-content-center">
    <div class="col-xl-12 text-center">
        <h3 class="mt-3">COVID-19 Contact Tracing Libmanan</h1>
        <h5 class="form_sub_title_registration">Citizen Download I-Card</h5>
    </div>
</div>

<!-- <div class="row mt-2 mb-5 justify-content-center" id="generateState">
    <div class="col-xl-3 col-lg-5 col-md-7 col-sm-8 col-12 form-id-columns" >
        <div class="text-center mb-4 mt-2">
                <div class="spinner-border text-primary" style="width: 5rem; height: 5rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
        </div>

        <p class="text-center m-0">The system is generating your <strong> Identification Card</strong>.</p>
        <p class="text-center m-0">Please wait, this will take few minutes/seconds.</p>
    </div>
</div> -->


<div class="row mt-2 mb-5 idrow justify-content-sm-center" id="idGenerated"> 
    <div class="col-xl-5 col-lg-6 col-md-7 col-sm-12 col-12 form-id-columns">

        <div class="alert alert-info d-none" id="downloadAlert" role="alert">
            Download will start in just a seconds. If your download does not start automatically <a href="#" id="redownload">click here</a>
        </div>

        <div class=" card card-id text-black" id="person">
            <img src="{{asset('images/system/id-format.png')}}" class="mt-3 mb-5 card-img mx-auto id-format" alt="Profile" >
            <div class="card-img-overlay">
                <div class="row mt-2">
                    <div class="col-6">
                        <img src="{{asset('/images/profileid/'.$data->citizens_img_src)}}" class="id-profile" width="192px" height="192px" alt="profile" id="img-citizen" onload="profileLoad();">
                    </div>

                    <div class="col-6">
                        <dl class="row id-details-row">
                            <dt class="col-sm-12">Full Name</dt>
                            <dd class="col-sm-12">
                                {{
                                    strtolower($data->citizens_fname) . ' ' . 
                                    strtolower(substr($data->citizens_mname, 0, 1)). '. ' . 
                                    strtolower($data->citizens_lname ). ' ' . 
                                    strtoupper($data->citizens_suffix)
                                }}
                            </dd>
                            <dt class="col-sm-12">Address</dt>
                            <dd class="col-sm-12">
                                @if($data->citizen_add_address_current != null)
                                    {{
                                        strtolower($data->citizen_add_address_current). ', '
                                    }}
                                @endif

                                @if($data->CitizenToZone != null)
                                    {{
                                        strtolower($data->CitizenToZone->zones_name). ', '
                                    }}
                                @endif

                                {{ 
                                    strtolower($data->CitizenToBarangay-> barangays_name) . ', '.
                                    strtolower($data->CitizenToMunicipality-> municipalities_name) . ', '.
                                    strtolower($data->CitizenToProvince-> province_name)
                                }}
                            </dd>
                
                            <dt class="col-sm-12">Gender</dt>
                            <dd class="col-sm-12">{{ strtolower($data->citizens_gender) }}</dd>
                        </dl>
                    </div>
                </div>

                <div class="row qr-code-row justify-content-center mt-2">
                    <img class="w-100" src="{{ asset('/images'.$data->citizens_qr_src)}}" alt="">
                </div>

            </div>
        </div>

        <button class="btn btn-success btn-block btn-lg" id="download-d">DOWNLOAD IDENTIFICATION CARD</button>
        <a href="/" class="btn btn-secondary mt-3 btn-block ">Back to Home</a>

    </div>


</div>

@endsection