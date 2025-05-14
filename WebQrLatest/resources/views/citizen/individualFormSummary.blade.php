@extends('layouts.layout_registration')

@section('title', 'Generated Identification Card')

@section('import-js')
    <script src="{{ asset('js/citizen/registration-download.js') }}"></script>
@endsection


@section('content')

<div class="row">
    <div class="col-xl-12 text-center">
        <h3 class="mt-3">COVID-19 Contact Tracing Libmanan</h3>
        <h5 class="form_sub_title_registration">Step 3 of 3 : Download Identification Card</h5>
    </div>
</div>

<div class="row mt-2 mb-5 justify-content-center" id="generateState">
    <div class="col-xl-4 col-lg-5 col-md-7 col-sm-8 col-12 form-id-columns" >
        <div class="text-center mb-4 mt-2">
                <div class="spinner-border text-primary" style="width: 5rem; height: 5rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
        </div>

        <p class="text-center m-0">The system is generating your <strong> Identification Card</strong>.</p>
        <p class="text-center m-0">Please wait, this will take few minutes/seconds.</p>
    </div>
</div>

<div class="row mt-2 mb-5 idrow justify-content-sm-center d-none" id="idGenerated"> 
    <div class="col-xl-5 col-lg-6 col-md-7 col-sm-12 col-12 form-id-columns">

        <div class="alert alert-info d-none" id="downloadAlert" role="alert">
            Download will start in just a seconds. If your download does not start automatically <a href="#" id="redownload">click here</a>
        </div>

        <div class=" card card-id text-black" id="person">
            <img src="{{asset('images/system/id-format.png')}}" class="mt-3 mb-5 card-img mx-auto id-format" alt="Profile" >
            <div class="card-img-overlay">
                <div class="row mt-2">
                    <div class="col-6">
                        <img src="{{asset('/images/profileid/'.$data[0]->citizens_img_src)}}" class="id-profile" width="192px" height="192px" alt="profile" id="img-citizen" onload="profileLoad();">
                    </div>

                    <div class="col-6">
                        <dl class="row id-details-row">
                            <dt class="col-sm-12">Full Name</dt>
                            <dd class="col-sm-12">
                                {{
                                    strtolower($data[0]->citizens_fname) . ' ' . 
                                    strtolower(substr($data[0]->citizens_mname, 0, 1)). '. ' . 
                                    strtolower($data[0]->citizens_lname ). ' ' . 
                                    strtoupper($data[0]->citizens_suffix)
                                }}
                            </dd>
                            <dt class="col-sm-12">Address</dt>
                            <dd class="col-sm-12">
                                @if($data[0]->citizen_add_address_current != null)
                                    {{
                                        strtolower($data[0]->citizen_add_address_current). ', '
                                    }}
                                @endif

                                @if($data[0]->CitizenToZone != null)
                                    {{
                                        strtolower($data[0]->CitizenToZone->zones_name). ', '
                                    }}
                                @endif

                                {{ 
                                    strtolower($data[0]->CitizenToBarangay-> barangays_name) . ', '.
                                    strtolower($data[0]->CitizenToMunicipality-> municipalities_name) . ', '.
                                    strtolower($data[0]->CitizenToProvince-> province_name)
                                }}
                            </dd>
                
                            <dt class="col-sm-12">Gender</dt>
                            <dd class="col-sm-12">{{ strtolower($data[0]->citizens_gender) }}</dd>
                        </dl>
                    </div>
                </div>

                <div class="row qr-code-row justify-content-center mt-2">
                    <img class="w-100" src="{{ asset('/'.$data[0]->citizens_qr_src)}}" alt="">
                </div>

            </div>

        </div>

        <button class="btn btn-success btn-block btn-lg" id="download">DOWNLOAD IDENTIFICATION CARD</button>
        <a href="/" class="btn btn-secondary mt-3 btn-block ">Back to Home</a>

    </div>

    <script>
        

        
    </script>

</div>  
@endsection