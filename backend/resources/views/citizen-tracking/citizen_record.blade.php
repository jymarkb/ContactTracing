@extends('layouts.layout_common')

@section('title', ' Tracking')

@section('js-import')
<script src="{{ asset('js/citizen/tracking-record.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/dtCSS/datatables.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/dtCSS/responsive.dataTables.min.css') }}"/>

<script type="text/javascript" src="{{ asset('js/dtJS/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dtJS/dataTables.responsive.min.js') }}"></script>

@endsection
    

@section('content')
    
<section id="id-verification">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12 text-center">
                <h1 class="mt-3">COVID-19 Contact Tracing Libmanan</h1>
                <h3 class="form_sub_title_registration">Citizen Check-in Tracking</h3>
            </div> 
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-11 col-md-11 col-sm-11 col-12 track-columns  mt-3 mb-5">
                <div class="row">
                  <div class="col-xl-4 col-lg-5 col-md-4 col-sm-12 col-12 text-center">
                    <div class="row justify-content-center">
                      <div class="col-xl-10 col-lg-9 col-md-12 col-sm-6 col-6">
                        <img src="/images/profileid/{{ $citizen->citizens_img_src }}" class="w-100  align-middle" idth="192px" height="192px" alt="">
                      </div>
                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-6 col-6 text-md-center text-left">
                        <h5 class="card-title mt-md-3 mb-0">
                            {{ ucwords(strtolower($citizen->citizens_fname)) . ' ' .  ucwords(strtolower($citizen->citizens_mname)) . ' '. ucwords(strtolower($citizen->citizens_lname)) }}

                            @if($citizen->citizens_suffix != null)
                                {{ ' ' . $citizen->citizens_suffix }}
                            @endif
                        </h5>
                        <p class="m-0">
                            {{ $citizen->citizens_gender }}
                        </p>
                        <p class="m-0">
                            {{ date("M d, Y", strtotime($citizen->citizens_bday)) }}
                        </p>
                        <p class="m-0">
                            {{ $citizen->citizens_profession }}
                        </p>
                        <p class="m-0">
                            @if($citizen->citizens_add_address_current)
                                {{ $citizen->citizens_add_address_current .  ', ' }}
                            @endif

                            @if($citizen->zones_id_current != null)
                                {{ $citizen->CitizenToZone->zones_name . ', ' }}

                            @endif

                            {{ $citizen->CitizenToBarangay->barangays_name . ', ' . ucwords(strtolower($citizen->CitizenToMunicipality->municipalities_name)) . ', ' . ucwords(strtolower($citizen->CitizenToProvince->province_name))}}
                        </p>
                        <p class="m-0">
                            {{ '+63' .substr($citizen->citizens_mobile,1)}}
                        </p>
                  
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-8 col-lg-7 col-md-8 col-sm-12 col-12 citizen-history">
                    <h3 class="mt-3">Citizen History</h3>
                    <p class="font-italic">Updated as of {{$curDate}}</p>


                    <div class="table-responsive">
                        <table id="citizen_history_scan"  class="table table-sm table-hover cell-border dt-responsive" cellspacing="0" style="width:100%">
                          <thead >
                            <tr>
                              <th>#</th>
                              <th>Establishment Name</th>
                              <th>Time in</th>
                              <th>Time out</th>
                              <th>Date</th>
                              
                            </tr>

                          </thead>
                        </table>

                      </div>
                    <!-- <div class="row">
                      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Date</span>
                          </div>
                          <input type="text" class="form-control" id="datepicker">
                          <div class="input-group-append">
                            <span class="input-group-text" id="callendarIcon"><i class="far fa-calendar"></i></span>
                          </div>
                        </div>
                      </div>

                      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Status</label>
                          </div>
                          <select class="custom-select" id="inputGroupSelect01">
                            <option selected value="0">Show all</option>
                            <option value="1">Check in</option>
                            <option value="2">Cehck out</option>
                          </select>
                        </div>
                    </div> -->



                  </div>

                  <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                      
                      <!-- <table id="tableCitizen" class="table table-hover display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                              <th>Establishment</th>
                              <th>Status</th>
                              <th>Date</th>
                              <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                      </table>  -->

                      

                      
                    </div>
                  </div>
                </div>

            </div>
        </div>

 
    </div>
    
</section>

@endsection