@extends('cbsua.layout')

@section('title', '- I-Card')

@section('import')
    <!-- <script src="{{ asset('js/html2canvas.min.js') }}"></script> -->
    <link href="{{ asset('css/styleRegistrationId.css') }}" rel="stylesheet">
    <!-- <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script> -->

    <!-- <script src="{{ asset('js/FileSaver.js') }}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/es6-promise/4.2.8/es6-promise.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/es6-promise/4.2.8/es6-promise.auto.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
    <!-- <script src="{{ asset('js/espromise/es6-promise.auto.js') }}"></script> -->
    <!-- <script src="{{ asset('js/espromise/es6-promise.js') }}"></script> -->
    <!-- <script src="{{ asset('js/dom-to-image.js') }}"></script> -->

    
    
@endsection


@section('content')

<div class="row mt-5">
    <div class="col-xl-12 text-center">
        <h1 class="mt-3" id="titleTop">Central Bicol State University Tracing App</h1>
        <h3 class="form_sub_title_registration">DOWNLOAD I-CARD</h3>
    </div>
</div>

<div class="row mt-2 mb-5 idrow justify-content-sm-center" id="idGenerated"> 
    <div class="col-xl-5 col-lg-6 col-md-7 col-sm-12 col-12 form-id-columns bg-white border-0">

        <div class="alert alert-info d-none" id="downloadAlert" role="alert">
            Please wait your download will start in just a seconds. If your download does not start automatically <a href="#" id="redownload">click here</a>
        </div>

        <div class=" card card-id text-black border-0 rounded-0" id="person" style="height:743px;">
            <img src="{{asset('images/cbsua/idformat.png')}}" class="mt-3 mb-5 card-img mx-auto id-format" style="width:384px; height:672px;" alt="Profile" >
            <div class="card-img-overlay">
                <div class="row mt-2">
                    <div class="col-6">
                        <img src="{{asset('/images/profileid/'.$data[0]->citizens_img_src)}}" class="id-profile" width="192px" height="192px" alt="profile" id="img-citizen">
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
                    <img class="w-100" style="width:376px;height:376px " src="{{ asset('/'.$data[0]->citizens_qr_src)}}" alt="">
                </div>

            </div>

        </div>

        <button class="btn btn-success btn-block btn-lg" id="download">DOWNLOAD IDENTIFICATION CARD</button>
        <a href="/" class="btn btn-secondary mt-3 btn-block ">Back to Home</a>

    </div>

</div> 

<script>
    $('#download').click(function(){
    $('#downloadAlert').removeClass('d-none');
    window.scrollTo(0,0);
    domtoimage.toJpeg(document.getElementById('person'))
        .then(function (blob) {
            document.getElementById("redownload").href = blob;
            document.getElementById("redownload").download = 'id.png';
            window.saveAs(blob, 'id.png');
        });
    });
</script>





@endsection

