@extends('layouts.layout_admin')

@section('title', 'Symptoms / Add New')

@section('css-import')
<link href="{{ asset('css/AdminCSS/admin.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('css/dtCSS/datatables.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/dtCSS/responsive.dataTables.min.css') }}"/>

<style>
  table.dataTable.no-footer{
  border-bottom: 0;
  }

  .dataTables_filter {
   float: left !important;
  }
</style>
@endsection

@section('js-import-add')
<script type="text/javascript" src="{{ asset('js/dtJS/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dtJS/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dtJS/dataTables.select.min.js') }}"></script>
<script src="{{ asset('js/Admin/admin.js') }}"></script>
<script src="{{ asset('js/Misu/misu-tracing.js') }}"></script>
@endsection

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">/ <span class="add-title">Tracing</span></h1>
    <!-- <button class='btn btn-primary' id="test">test</button> -->
</div>

<div class="row">
  <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12 mb-3">
    <div class="accordion" id="accordionExample">
      <div class="card shadow border-0">
        <div class="card-header bg-white pt-lg-3 pb-lg-0 border-0" id="headingOne">
          <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-11 col-sm-11 col-11">
              <h4 class="mb-0 mt-0 font-weight-bold text-primary">Citizen List</h4>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-1 col-sm-1 col-1 text-right">
              <button class="btn mb-0 mt-0 p-0 text-primary d-lg-none d-block btn-block" data-toggle="collapse" data-target="#list-collapse" aria-expanded="false" aria-controls="list-collapse"><i class="fa fa-plus"></i></button>
            </div>
          </div>
        </div>

        <div id="list-collapse" class="collapse d-lg-block">
          <div class="card-body">
            <input type="text" class="form-control mb-2" id="search-list" placeholder="Search for ... ">
            <div class="row overflow-auto" style="max-height:550px;" id="list-trace">
              <!-- <div class="col-xl-12">
                <div class="card rounded-0 border-0 card-border listctz">
                  <div class="card-body p-2 px-3 trace-citizen">
                    Jay Mark A. Borja
                  </div>
                </div>
                <hr class="sidebar-divider m-0 mt-1 mb-1">
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
    <div class="card border-0 mb-4 bg-transparent">
      <div class="row">
        <div class="col-xl-7 col-lg-12 order-12 order-xl-0">
          <div class="card shadow mb-3">
            <div class="card-body">
              <h3 class="font-weight-bold text-primary m-0">Tracing Report</h3>
              <div class="row">
                <div class="col-xl-12">
                  <ul class="timeline" id="trace-list-report">
                    <li class="es-row text-side-info" ><h4>Please select citizen name on the list.</h4></li>
                    <!-- <li class="es-row" >
                      <div class="row">
                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-8">
                          <h6 class="text-es-title font-weight-bold m-0 p-0 mt-1">Establishment Name 1</h6>
                          <p class="small text-side-info mb-2 p-0">Zone 6, Libod 1, Libmanan, Camarines Sur</p>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-4 text-center text-white bg-es-title">
                          <h5 class="font-weight-bold m-0 mt-1">23</h5>
                          <p class="small mb-2 p-0 font-weight-bold text-nowrap">February</p>
                        </div>
                      </div>
                      <div class="row border-top border-secondary text-side-info">
                        <p class="small font-weight-bold mt-1">Interacted with :</p>
                          <div class="col-xl-12">
                            <div class="card border-0 rounded-0 pb-2">
                              <div class="card-body p-0">
                                <div class="row">
                                  <div class="col-sm-2 col-3 d-flex align-items-center">
                                    <img src="/storage/profiles/noprofile.png" alt="" class="rounded-circle w-100">
                                  </div>
                                  <dd class="col-sm-10 col-9 align-self-center">
                                    <p class="font-weight-bold p-0 m-0">Jay Mark A. Borja <span class="badge badge-light border border-primary text-primary ">10 min</span></p>
                                    <p class="small p-0 m-0">Zone 5, Bagumbayan, Libmanan, Camarines Sur</p>
                                  </dd>
                                </div>
                                
                              </div>
                            </div>
                            <hr class="sidebar-divider m-0 mt-1 mb-2">

                          </div>
                      </div>
                    </li> -->
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-xl-5 col-lg-12 order-0 order-xl-12">
          <div class="card border-0 shadow mb-3 d-none" id="card-citizen-info">
            <div class="card-body">
              <h4 class="font-weight-bold text-primary text-truncate" id="trace-name"></h4>
              <div class="row text-side-info">
                <dt class="col-xl-5 col-md-3 col-sm-3">Gender</dt>
                <dd class="col-xl-7 col-md-3 col-sm-3" id="trace-gender"></dd>
                <dt class="col-xl-5 col-md-3 col-sm-3">Age</dt>
                <dd class="col-xl-7 col-md-3 col-sm-3" id="trace-age"></dd>
                <dt class="col-xl-5 col-md-3 col-sm-3">Birth Day</dt>
                <dd class="col-xl-7 col-md-3 col-sm-9" id="trace-bday"></dd>
                <dt class="col-xl-5 col-md-3 col-sm-3" >Contact</dt>
                <dd class="col-xl-7 col-md-3 col-sm-9" id="trace-mobile"></dd>
                <dt class="col-xl-5">Address</dt>
                <dd class="col-xl-7" id="trace-address"></dd>
              </div>
            </div>
          </div>

          <div class="card shadow mb-3 d-none">
            <div class="card-body">
              <h5 class="font-weight-bold text-primary">Case Information</h5>
              <div class="row">
                <dt class="col-sm-5">Status</dt>
                <dd class="col-sm-7" id="trace-description">Symptomatic</dd>
                <dt class="col-sm-5">Facility</dt>
                <dd class="col-sm-7" id="trace-facility">N/A</dd>
                <dt class="col-sm-5">Tag Description</dt>
                <dd class="col-sm-7">Positive</dd>
              </div>
            </div>
          </div>

          <div class="card shadow mb-3 d-none">
            <div class="card-body">
            <h5 class="font-weight-bold text-primary">Monitoring History</h5>
               <H1 class="text-center">NO DATA</H1>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="card-header py-3">
        <h4 class="mb-0 mt-0 font-weight-bold text-primary">Tracing Information</h4>
      </div>
      <div class="card-body">
        
        <input type="text" class="form-control mb-1" id="search-list" placeholder="Search for ... ">
        <div class="accordion" id="accordionExample">
          <div class="card rounded-0">
            <div class="card-header bg-dark p-0" id="headingOne">
              <button class="btn btn-block text-left text-white " type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <i class="fa fa-plus text-success"></i> Jay Mark A. Borja
              </button>
            </div>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <div class="row mb-2">
                  <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6 mb-2 text-center">
                    <img src="/storage/profiles/noprofile.png" alt="" class="w-100">
                  </div>
                  <div class="col-xl-9 col-lg-8 col-md-7 col-sm-12">
                    <h5 class="font-weight-bold text-primary">Personal Information</h5>
                    <div class="row">
                      <dt class="col-xl-3 col-lg-4 col-md-5 col-sm-5 col-5">Name</dt>
                      <dd class="col-xl-9 col-lg-8 col-md-7 col-sm-7 col-7">Jay Mark A. Borja</dd>
                      <dt class="col-xl-3 col-lg-4 col-md-5 col-sm-5 col-5">Gender</dt>
                      <dd class="col-xl-9 col-lg-8 col-md-7 col-sm-7 col-7">Male</dd>
                      <dt class="col-xl-3 col-lg-4 col-md-5 col-sm-5 col-5">Age</dt>
                      <dd class="col-xl-9 col-lg-8 col-md-7 col-sm-7 col-7">21</dd>
                      <dt class="col-xl-3 col-lg-4 col-md-5 col-sm-5 col-5">Birth Day</dt>
                      <dd class="col-xl-9 col-lg-8 col-md-7 col-sm-7 col-7">May 20, 1999</dd>
                      <dt class="col-xl-3 col-lg-4 col-md-5 col-sm-5 col-5">Contact #</dt>
                      <dd class="col-xl-9 col-lg-8 col-md-7 col-sm-7 col-7">09123456789</dd>
                      <dt class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-5">Address</dt>
                      <dd class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-7">Zone 6, Bagumbayan, Libmanan Camarines Sur</dd>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div> -->
    </div>
  </div>
</div>







@endsection