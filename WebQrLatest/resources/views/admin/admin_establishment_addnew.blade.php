@extends('layouts.layout_admin')

@section('title', 'Establishment / Add New')

@section('css-import')
<link href="{{ asset('css/styleRegistration.css') }}" rel="stylesheet">
<link href="{{ asset('css/AdminCSS/admin.css') }}" rel="stylesheet">
@endsection

@section('js-import-add')
<script src="{{ asset('js/Admin/admin.js') }}"></script>
<script src="{{ asset('js/Admin/admin-es-addnew.js') }}"></script>
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Establishment / <span class="add-title">Add New</span></h1>
</div>
<form class="row" method="POST" enctype="multipart/form-data" id="establishment-add" action="javascript:void(0)" >
    @csrf
    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h3 class="mb-0 mt-1 font-weight-bold text-primary">Owner</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input type="text" class="form-control " id="es_fname" autocomplete="off" placeholder="e.g (Jay Mark)" name="es_fname" maxlength="20">
                    <label class="lblForm" id="lblFirst" for="es_fname">First Name</label>
                    <div id="validFirst" class="invalid-feedback">Please fill the field with firstname (e.g Jay Mark)</div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="es_mname" autocomplete="off" placeholder="(e.g: Aureus)" name="es_mname" maxlength="20"> 
                    <label class="lblForm" id="lblMiddle" for="es_mname">Middle Name</label>
                    <div id="validMiddle" class="invalid-feedback">Please fill the field with middle name (e.g Aureus)</div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="es_lname" autocomplete="off" placeholder="(e.g: Borja)" name="es_lname" maxlength="20">
                    <label class="lblForm" id="lblLast"  for="es_lname">Last Name</label>
                    <div id="validLast" class="invalid-feedback">Please fill the field with lastname (e.g Borja)</div>
                </div>
                <p class="mb-2 text-dark"><strong>Suffix</strong></p>
                <div class="form-group">
                    <select id="es_suffix" class="form-control" equired autocomplete="off" name="es_suffix">
                        <option value="0">none</option>
                        <option value="I">I</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
                        <option value="V">V</option>
                        <option value="JR">JR</option>
                        <option value="SR">SR</option>
                    </select>
                    <small id="suffixHelp" class="form-text text-muted">Please fill the field with suffix (I, II, JR, SR).Optional if you don't have.</small>
                </div>
                <div class="form-group">
                    <select id="es_gender" class="form-control" equired autocomplete="off" name="es_gender">
                        <option value="0" selected hidden></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <label class="lblForm" id="es_lblGender"  for="es_gender">Gender</label>
                    <div class="invalid-feedback">Please select gender.</div>
                </div>
                <p class="mb-2">Birthday</p>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-5 col-sm-5 col-4">
                        <div class="form-group">
                            <select id="es_month" class="form-control" equired autocomplete="off" name="es_month">
                                <option selected="" hidden="" value="0"> </option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            <label class="lblForm" id="es_lblmonth"  for="es_month">Month</label>
                            <div class="invalid-feedback">Please select birth month.</div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-4">
                        <div class="form-group">
                            <input type="number" class="form-control" id="es_day" autocomplete="off" placeholder="DD" name="es_day" maxlength="2">
                            <label class="lblForm" id="es_lblday"  for="es_day">Day</label>
                            <div id="validMonth" class="invalid-feedback">Please fill birth day. (e.g 20)</div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-4">
                        <div class="form-group">
                            <input type="number" class="form-control" id="es_year" autocomplete="off" placeholder="YYYY" name="es_year" maxlength="4">
                            <label class="lblForm" id="es_lblyear"  for="es_year">Year</label>
                            <div id="validMonth" class="invalid-feedback">Please fill birth year. (e.g 1999)</div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" id="es_number" autocomplete="off" placeholder="(e.g: 09XXXXXXXXX)" name="es_number" maxlength="11">
                    <label class="lblForm" id="es_lblnumber"  for="es_number">Mobile Number</label>
                    <div id="validMobileA" class="invalid-feedback">Please fill the field with 11 digit mobile number (e.g 09XXXXXXXXX)</div>
                    <div id="validMobileB" class="invalid-feedback">Please enter mobile number not used in previous registration.</div>
                </div>  
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card shadow mb-5">
            <div class="card-header">
                <h3 class="mb-0 mt-1 font-weight-bold text-primary">Establishment</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input type="text" class="form-control " id="es_company" autocomplete="off" placeholder="e.g (Jollibee)" name="es_company" maxlength="20">
                    <label class="lblForm" id="es_lblcompany" for="es_company">Name</label>
                    <div class="invalid-feedback">Please fill the field with establishment name(e.g Jollibee)</div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control " id="es_permit" autocomplete="off" placeholder="e.g (123-456-789)" name="es_permit" maxlength="20">
                    <label class="lblForm" id="es_lblpermit" for="es_permit">Permit #</label>
                    <div class="invalid-feedback">Please fill the field with Mayor's Permit (e.g 123-456-789)</div>
                </div>
                <p class="mb-2">Establishment Address</p>
                <div class="form-group">
                    <select id="es_brgy" class="form-control" required  autocomplete="off" name="es_brgy">
                        <option value="0" hidden selected></option>
                        @foreach ($data as $brgy)
                            <option value="{{$brgy->barangays_id}}">{{ ucwords(strtolower($brgy->barangays_name)) }}</option>
                        @endforeach
                    </select>
                    <label for="es_brgy" class="label-barangay lblForm">Barangay</label>
                    <div id="validFirst" class="invalid-feedback">Please select barangay.</div>
                </div>
                <div class="form-group">
                    <select id="es_zone" class="form-control" required autocomplete="off" name="es_zone">
                        
                    </select>
                    <label for="es_zone" id="es_lblzone" class="es_lblZone lblForm">Zone</label>
                    <div id="validFirst" class="invalid-feedback">Please select zone.</div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="es_details" autocomplete="off" placeholder="e.g (2nd Flr, Building Name)" name="es_details">
                    <label for="es_details" class="details-reg es_lblDetail lblForm">House/Unit/Flr #, Bldg Name, Blk or Lot#</label>
                    <small id="suffixHelp" class="form-text text-muted">Optional, if don't have.</small>
                </div>
          
            </div>
        </div>
    </div>
</form>
<div class="row justify-content-center mt-5 mb-2">
    <div class="col-xl-8 col-lg-10 col-md-12 col-sm-12 col-12">
        <button id="addnew_establishment" class="btn btn-primary btn-lg btn-block">Add New</button>
    </div>
</div>

<div class="toast" style="" id="register-toast" data-delay="3000">
    <div class="toast-header bg-danger text-white">
        <strong class="mr-auto">Error</strong>
        <small>just now</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        Please fill with your information all require(*) fields.
    </div>
</div>
<div class="toast" style="" id="exist-toast" data-delay="3000">
    <div class="toast-header bg-danger text-white">
        <strong class="mr-auto">Error</strong>
        <small>just now</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        The establishment information is existed in the system.
    </div>
</div>
<div class="toast" style="" id="success-toast" data-delay="3000">
    <div class="toast-header bg-success text-white">
        <strong class="mr-auto">Success</strong>
        <small>just now</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        You've successfully added a establishment.
    </div>
</div>



@endsection