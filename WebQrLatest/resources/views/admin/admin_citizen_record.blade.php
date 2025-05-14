@extends('layouts.layout_admin')

@section('title', 'Citizen / Records')

@section('css-import')
<link href="{{ asset('css/AdminCSS/admin.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('css/dtCSS/datatables.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/dtCSS/responsive.dataTables.min.css') }}"/>
@endsection

@section('js-import-add')
<script type="text/javascript" src="{{ asset('js/dtJS/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dtJS/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dtJS/dataTables.select.min.js') }}"></script>
<script src="{{ asset('js/Admin/admin.js') }}"></script>
<script src="{{ asset('js/Admin/admin-citizen-dt.js') }}"></script>
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Citizen / <span class="add-title">Records</span></h1>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-xl-9 col-lg-8 col-md-7 col-sm-12 col-12 mb-3 mb-md-0">
                        <h3 class="m-0 font-weight-bold text-primary">Citizen Table</h3>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-5 col-sm-12 col-12 d-flex  justify-content-md-end">
                        <button class="btn btn-sm btn-primary shadow-sm" id="generateInfo">
                            <i class="fas fa-download fa-sm text-white-50"></i> Generate Information
                        </button>
                        <a href="/download/generatedFilter" class="btn btn-sm d-none btn-primary shadow-sm" id="downloadFilter">
                            <i class="fas fa-download fa-sm text-white-50"></i> Generate Information
                        </a>
                        <a href="/download/generatedNoFilter" class="btn btn-sm d-none btn-primary shadow-sm" id="downloadNoFilter">
                            <i class="fas fa-download fa-sm text-white-50"></i> Generate Information
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <a class="filter-btn mr-2" id="filter-btn" type="button" data-toggle="collapse" data-target="#FilterCollapse" aria-expanded="false">
                     <i class="fa fa-sliders-h"></i> Advance Filter
                </a>
                <div class="collapse" id="FilterCollapse">
                    <div class="card card-body">
                        <div class="row justify-content-md-center">
                            <div class="col-xl-2 col-lg-3 col-md-12">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                        <div class="row">
                                            <dt class="col-sm-12">Gender</dt>
                                            <dd class="col-sm-12 mt-1">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="Male" id="filterMale">
                                                    <label class="custom-control-label" for="filterMale">Male</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="Female" id="filterFemale">
                                                    <label class="custom-control-label" for="filterFemale">Female</label>
                                                </div>
                                            </dd>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                        <div class="row">
                                            <dt class="col-sm-12 mt-lg-3">Verification</dt>
                                            <dd class="col-sm-12 mt-1">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="1" id="filterVerified">
                                                    <label class="custom-control-label" for="filterVerified">Verified</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="2" id="filterNotVerified">
                                                    <label class="custom-control-label" for="filterNotVerified">Not Verified</label>
                                                </div>
                                            </dd>

                                        
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-4 col-md-12">
                                <dl class="row">
                                    <dt class="col-sm-12">Permanent Address</dt>
                                    <dd class="col-sm-12 mt-1">
                                        <p class="mb-1 mt-1">Province</p>
                                        <select class="custom-select" id="per_province">
                                            <option selected value="0" hidden>Select Province</option>
                                            @foreach ($getProvince as $province)
                                                <option value="{{ $province->province_id }}">{{ $province->province_name }}</option>
                                            @endforeach
                                        </select>
                                        <p class="mb-1 mt-1">Municipality</p>
                                        <select class="custom-select" id="per_municipality">
                                            <option selected value="0" hidden>Select Municipality</option>
                                            <option value="0" disabled>Please select Province first.</option>
                                            
                                        </select>
                                        <p class="mb-1 mt-1">Barangay</p>
                                        <select class="custom-select" id="per_barangay">
                                            <option selected value="0" hidden>Select Barangay</option>
                                            <option value="0" disabled>Please select Municipality first.</option>
                                            
                                        </select>
                                        <p class="mb-1 mt-1" id="lbl-zone-per">Zone</p>
                                        <select class="custom-select" id="per_zone">
                                            <option selected value="0" hidden>Select Zone</option>
                                            <option value="0" disabled>Please select Barangay first.</option>
                                        </select>
                                    </dd>
                                </dl>
                            </div>

                            <div class="col-xl-3 col-lg-4 col-md-12">
                                <dl class="row">
                                    <dt class="col-sm-12">Current Address</dt>
                                    <dd class="col-sm-12 mt-1">
                                        <p class="mb-1 mt-1">Province</p>
                                        <select class="custom-select" id="cur_province"> 
                                            <option selected value="0" hidden>Select Province</option>
                                            @foreach ($getProvince as $province)
                                                <option value="{{ $province->province_id }}">{{ $province->province_name }}</option>
                                            @endforeach
                                        </select>
                                        <p class="mb-1 mt-1">Municipality</p>
                                        <select class="custom-select" id="cur_municipality">
                                            <option selected value="" hidden>Select Municipality</option>
                                            <option value="0" disabled>Please select Province first.</option>
                                            
                                        </select>
                                        <p class="mb-1 mt-1">Barangay</p>
                                        <select class="custom-select" id="cur_barangay">
                                            <option selected value="" hidden>Select Barangay</option>
                                            <option value="0" disabled>Please select Municipality first.</option>
                                        </select>
                                        <p class="mb-1 mt-1" id="lbl-zone-cur">Zone</p>
                                        <select class="custom-select" id="cur_zone">
                                            <option selected value="" hidden>Select Zone</option>
                                            <option value="0" disabled>Please select Barangay first.</option>
                                        </select>
                                    </dd>
                                </dl>
                            </div>
                            
                        </div>

                        <div class="row justify-content-end">
                            <button class=" m-2 btn btn-secondary text-white" id="filter-reset-btn">
                                Reset
                            </button>
                            <button class="m-2 btn btn-primary text-white" id="filter-set-btn">
                                Filter
                            </button>
                        </div>
                    </div>
                </div>

                <hr class="sidebar-divider">

                <div class="table-responsive">
                    <table id="citizen_info"  class="table table-hover cell-border dt-responsive" cellspacing="0" width="100%">
                        <thead class="text-white"> 
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Name</th>
                                <th>Name</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Mobile</th>
                                <th class="text-nowrap">Occupation</th>
                                <th class="text-nowrap">Permanent Address</th>
                                <th>zone</th>
                                <th>brgy</th>
                                <th>muni</th>
                                <th>prov</th>
                                <th class="text-nowrap">Current Address</th>
                                <th>curzone</th>
                                <th>curbrgy</th>
                                <th>curmuni</th>
                                <th>curprov</th>
                                <th>Verification</th>
                                <th class="min-tablet">Action</th>
                            </tr>
                        </thead>

                    </table >
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="citizens_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog  modal-xl" id="modal-citizen" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Citizen Information</h5>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" id="citizenUpdate" action="javascript:void(0)" class="row">
            @csrf
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 form-dt">
                <h5>Personal Information</h5>
                <dt class="col-sm-12 edt_ct_lbl">First Name</dt>
                <dd class="col-sm-12">
                    <input type="text" class="form-control" autocomplete="off" placeholder="e.g (Jay Mark)" id="edt_ct_fname" name="edt_ct_fname" maxlength="20">
                    <div id="validFirst" class="invalid-feedback">Please fill the field with citizen firstname (e.g Jay Mark)</div>
                </dd>
                <dt class="col-sm-12 edt_ct_lbl">Middle Name</dt>
                <dd class="col-sm-12">
                    <input type="text" class="form-control" autocomplete="off" placeholder="(e.g: Aureus)" id="edt_ct_mname" name="edt_ct_mname" maxlength="20">
                    <div id="validMiddle" class="invalid-feedback">Please fill the field with citizen middle name (e.g Aureus)</div>
                </dd>
                <dt class="col-sm-12 edt_ct_lbl">Last Name</dt>
                <dd class="col-sm-12">
                    <input type="text" class="form-control" autocomplete="off" placeholder="(e.g: Borja)" id="edt_ct_lname" name="edt_ct_lname" maxlength="20">
                    <div id="validLast" class="invalid-feedback">Please fill the field with citizen lastname (e.g Borja)</div>
                </dd>
                <dt class="col-sm-12">Suffix</dt>
                <dd class="col-sm-12">
                    <select id="edt_ct_suffix" class="form-control" equired autocomplete="off" name="edt_ct_suffix">
                        <option value="0">none</option>
                        <option value="I">I</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
                        <option value="V">V</option>
                        <option value="JR">JR</option>
                        <option value="SR">SR</option>
                    </select>
                    <small id="suffixHelp" class="form-text text-muted">Please fill the field with citizen suffix (I, II, JR, SR).Optional if you don't have.</small>
                </dd>
                <dt class="col-sm-12 mt-2 edt_ct_lbl">Birth Day</dt>
                <dd class="col-sm-12">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-5 col-sm-5 col-4">
                            <div class="form-group">
                                <label id="lblMonth" class="small m-0"  for="edt_ct_month">Month</label>
                                <select id="edt_ct_month" class="form-control" equired autocomplete="off" name="edt_ct_month">
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                                
                                <div id="validMonth" class="invalid-feedback">Please select citizen birth month.</div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-4">
                            <div class="form-group">
                                <label id="lblDay" class="small m-0" for="edt_ct_day">Day</label>
                                <input type="number" class="form-control" id="edt_ct_day" autocomplete="off" placeholder="DD" name="edt_ct_day" maxlength="2">
                                <div id="validMonth" class="invalid-feedback">Please fill citizen birth day. (e.g 20)</div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-4">
                            <div class="form-group">
                                <label id="lblYear" class="small m-0"  for="edt_ct_year">Year</label>
                                <input type="number" class="form-control" id="edt_ct_year" autocomplete="off" placeholder="YYYY" name="edt_ct_year" maxlength="4">
                                <div id="validMonth" class="invalid-feedback">Please fill citizen birth year. (e.g 1999)</div>
                            </div>
                        </div>
                    </div>
                </dd>
                <dt class="col-sm-12 edt_ct_lbl">Gender</dt>
                <dd class="col-sm-12">
                    <select class="form-control" id="edt_ct_gender" name="edt_ct_gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <div id="validLast" class="invalid-feedback">Please select your citizen gender.</div>
                </dd>
                <dt class="col-sm-12 edt_ct_lbl">Profession/Occupation</dt>
                <dd class="col-sm-12">
                    <input type="text" class="form-control" autocomplete="off" placeholder="(eg: Barbero, Teacher)" id="edt_ct_profession" name="edt_ct_profession" maxlength="100">
                    <div id="validLast" class="invalid-feedback">Please fill the field with citizen occupation (e.g Barbero, Teacher)</div>
                </dd>
                <dt class="col-sm-12 edt_ct_lbl">Mobile Number</dt>
                <dd class="col-sm-12">
                    <input type="number" class="form-control" id="edt_ct_mobile" autocomplete="off" placeholder="(e.g: 09XXXXXXXXX)" name="edt_ct_mobile" maxlength="11">
                    <div id="validMobileA" class="invalid-feedback">Please fill the field with citizen 11 digit mobile number (e.g 09XXXXXXXXX)</div>
                    <div id="validMobileB" class="invalid-feedback">Please enter mobile number not used in previous registration.</div>
                </dd>
                <dt class="col-sm-12 edt_ct_lbl">Profile Photo</dt>
                <dd class="col-sm-12">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="edt_ct_photo" name="edt_ct_photo" accept="image/x-png,image/jpeg,image/x-jpg" >
                        <label class="custom-file-label text-truncate" for="edt_ct_photo" id="photo-label">Profile Photo (Choose file)</label>
                        <small id="photoHelp" class="form-text text-muted">Please upload latest picture.</small>
                        <div id="validPhoto" class="invalid-feedback">Please upload latest picture.</div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-7 col-md-8 col-sm-8 col-8 ">
                            <img class="mt-2 mb-2" width="192px" height="192px" alt="" id="edt_ct_profile">
                        </div>
                        
                    </div>
                </dd>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 form-dt">
                <h5>Permanent Address</h5>
                <dt class="col-sm-12 edt_ct_lbl">Province</dt>
                <dd class="col-sm-12">
                    <select class="custom-select" id="edt_per_province" name="edt_ct_perProv">
                        @foreach ($getProvince as $province)
                            <option value="{{ $province->province_id }}">{{ $province->province_name }}</option>
                        @endforeach
                    </select>
                    <div id="validFirst" class="invalid-feedback">Please select your citizen province.</div>
                </dd>
                <dt class="col-sm-12 edt_ct_lbl">Municipality</dt>
                <dd class="col-sm-12">
                    <select class="custom-select" id="edt_per_municipality" name="edt_ct_perMuni">
                        
                    </select>
                    <div id="validFirst" class="invalid-feedback">Please select your citizen municipality.</div>
                </dd>
                <dt class="col-sm-12 edt_ct_lbl">Barangay</dt>
                <dd class="col-sm-12">
                    <select class="custom-select" id="edt_per_barangay" name="edt_ct_perBrgy">
                        
                    </select>
                    <div id="validFirst" class="invalid-feedback">Please select your citizen barangay.</div>
                </dd>
                <dt class="col-sm-12 edt_ct_lbl" id="zone-select-edt-lbl">Zone</dt>
                <dd class="col-sm-12" id="zone-select-edt">
                    <select class="custom-select" id="edt_per_zone" name="edt_ct_perZone1">
                        
                    </select>
                    <div id="validFirst" class="invalid-feedback">Please select your citizen zone.</div>
                </dd>
                <dt class="col-sm-12" id="zone-field-edt-lbl">Zone</dt>
                <dd class="col-sm-12" id="zone-field-edt">
                    <input type="text" class="form-control" autocomplete="off" placeholder="(eg: Zone 1)" id="edt_per_zone_field" name="edt_ct_perZone2">
                    <div id="validFirst" class="invalid-feedback">Please select your citizen zone.</div>
                </dd>
                <dt class="col-sm-12">House/Unit/Flr #, Bldg Name, Blk or Lot#</dt>
                <dd class="col-sm-12">
                    <input type="text" class="form-control"  autocomplete="off" placeholder="(e.g: Building Name 2nd Floor)" id="edt_per_bldg" name="edt_ct_perBldg">
                    <small id="suffixHelp" class="form-text text-muted">Optional if you don't have.</small>
                </dd>

                <h5 class="mt-3">Current Address</h5>
                <dt class="col-sm-12 edt_ct_lbl">Province</dt>
                <dd class="col-sm-12">
                    <select class="custom-select" id="edt_cur_province" name="edt_ct_curProv">
                        @foreach ($getProvince as $province)
                            <option value="{{ $province->province_id }}">{{ $province->province_name }}</option>
                        @endforeach
                    </select>
                    <div id="validFirst" class="invalid-feedback">Please select your citizen province.</div>
                </dd>
                <dt class="col-sm-12 edt_ct_lbl">Municipality</dt>
                <dd class="col-sm-12">
                    <select class="custom-select" id="edt_cur_municipality" name="edt_ct_curMuni">
                        
                    </select>
                    <div id="validFirst" class="invalid-feedback">Please select your citizen municipality.</div>
                </dd>
                <dt class="col-sm-12 edt_ct_lbl">Barangay</dt>
                <dd class="col-sm-12">
                    <select class="custom-select" id="edt_cur_barangay" name="edt_ct_curBrgy">
                        
                    </select>
                    <div id="validFirst" class="invalid-feedback">Please select your citizen barangay.</div>
                </dd>
                <dt class="col-sm-12 edt_ct_lbl" id="zone-select-edt-lbl-cur">Zone</dt>
                <dd class="col-sm-12" id="zone-select-edt-cur">
                    <select class="custom-select" id="edt_cur_zone" name="edt_ct_curZone1">
                        
                    </select>
                    <div id="validFirst" class="invalid-feedback">Please select your citizen zone.</div>
                </dd>
                <dt class="col-sm-12" id="zone-field-edt-lbl-cur">Zone</dt>
                <dd class="col-sm-12" id="zone-field-edt-cur">
                    <input type="text" class="form-control" autocomplete="off" placeholder="(e.g: Zone 1)" id="edt_cur_zone_field" name="edt_ct_curZone2">
                    <div id="validFirst" class="invalid-feedback">Please select your citizen zone.</div>
                </dd>

                <dt class="col-sm-12">House/Unit/Flr #, Bldg Name, Blk or Lot#</dt>
                <dd class="col-sm-12">
                    <input type="text" class="form-control" id="edt_cur_bldg" autocomplete="off" placeholder="(e.g: Building Name 2nd Floor)" name="edt_ct_curBldg">
                    <small id="suffixHelp" class="form-text text-muted">Optional if you don't have.</small>
                </dd>
                
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="edt_ct_cancel-btn">Close</button>
        <button type="button" class="btn btn-primary" id="edt_ct_update-btn">Save changes</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="update_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" id="modal-update" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Changes</h5>
                <button type="button" class="close text-danger cls-update-modal" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Do you want to save the change for this citizen record?</p>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="row" id="row-name">
                            <dt class="col-sm-12">Name</dt>
                            <dd class="col-sm-12">
                                <p class="m-0 text-danger"><strong><span class="fa fa-times"></span></strong> &nbspold : <span id="nameOld"></span></p>
                                <p class="m-0 text-success"><strong><span class="fa fa-check"></span></strong> new : <span id="nameNew"></span></p>
                            </dd>
                        </div>

                        <div class="row" id="row-bday">
                            <dt class="col-sm-12">Birth Day</dt>
                            <dd class="col-sm-12">
                                <p class="m-0 text-danger"><strong><span class="fa fa-times"></span></strong> &nbspold : <span id="bdayOld"></span></p>
                                <p class="m-0 text-success"><strong><span class="fa fa-check"></span></strong> new : <span id="bdayNew"></span></p>
                            </dd>
                        </div>

                        <div class="row" id="row-gender">
                            <dt class="col-sm-12">Gender</dt>
                            <dd class="col-sm-12">
                                <p class="m-0 text-danger"><strong><span class="fa fa-times"></span></strong> &nbspold : <span id="genderOld"></span></p>
                                <p class="m-0 text-success"><strong><span class="fa fa-check"></span></strong> new : <span id="genderNew"></span></p>
                            </dd>
                        </div>

                        <div class="row" id="row-profession">
                            <dt class="col-sm-12">Profession</dt>
                            <dd class="col-sm-12">
                                <p class="m-0 text-danger"><strong><span class="fa fa-times"></span></strong> &nbspold : <span id="professionOld"></span></p>
                                <p class="m-0 text-success"><strong><span class="fa fa-check"></span></strong> new : <span id="professionNew"></span></p>
                            </dd>
                        </div>

                        <div class="row" id="row-mobile">
                            <dt class="col-sm-12">Mobile</dt>
                            <dd class="col-sm-12">
                                <p class="m-0 text-danger"><strong><span class="fa fa-times"></span></strong> &nbspold : <span id="mobileOld"></span></p>
                                <p class="m-0 text-success"><strong><span class="fa fa-check"></span></strong> new : <span id="mobileNew"></span></p>
                            </dd>
                        </div>

                        <div class="row" id="row-photo">
                            <dt class="col-sm-12">Profile Photo</dt>
                            <dd class="col-sm-12">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                        <p class='m-0 text-danger'><strong><span class="fa fa-times"></span></strong> old</p>
                                        <img class="w-100" src="" id="photoOld" alt="old photo">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                    <p class='m-0 text-success'><strong><span class="fa fa-check"></span></strong> new</p>
                                        <img class="w-100" src="" id="photoNew" alt="new photo">
                                    </div>
                                </div>
                            </dd>
                        </div>

                        <div class="row" id="row-permanent">
                            <dt class="col-sm-12">Permanent Address</dt>
                            <dd class="col-sm-12">
                                <p class="m-0 text-danger"><strong><span class="fa fa-times"></span></strong> &nbspold : <span id="permanentOld"></span></p>
                                <p class="m-0 text-success"><strong><span class="fa fa-check"></span></strong> new : <span id="permanentNew"></span></p>
                            </dd>
                        </div>

                        <div class="row" id="row-current">
                            <dt class="col-sm-12">Current Address</dt>
                            <dd class="col-sm-12">
                                <p class="m-0 text-danger"><strong><span class="fa fa-times"></span></strong> &nbspold : <span id="currentOld"></span></p>
                                <p class="m-0 text-success"><strong><span class="fa fa-check"></span></strong> new : <span id="currentNew"></span></p>
                            </dd>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="update_data">Update</button>
            </div>
        </diV>
    </div>
</div>
<div class="modal fade" id="change_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" id="change-update" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Save Change</h5>
                <button type="button" class="close text-danger cls-update-modal" id="change_cls" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="m-0">Do you want to save the change for this citizen record?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="change_no">No</button>
                <button type="button" class="btn btn-primary" id="change_yes">Yes</button>
            </div>
        </diV>
    </div>
</div>
<div class="modal fade" id="view_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" id="change-update" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="blk_title">View Citizen Information</h5>
                <button type="button" class="close text-danger cls-update-modal" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="m-0" id="blk_subTitle"></p>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <img class="w-100 mt-3" alt="" id="blk_profile">
                        <h5 class=" mt-2 text-center" id="blk_verify"></h5>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="row mt-3">
                            <dt class="col-sm-12">Name</dt>
                            <dd class="col-sm-12" id="blk_name"></dd>
                            <dt class="col-sm-12">Birth Day</dt>
                            <dd class="col-sm-12" id="blk_bday"></dd>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="row">
                                            <dt class="col-sm-12">Age</dt>
                                            <dd class="col-sm-12" id="blk_age"></dd>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="row">
                                            <dt class="col-sm-12">Gender</dt>
                                            <dd class="col-sm-12" id="blk_gender"></dd>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <dt class="col-sm-12">Mobile</dt>
                            <dd class="col-sm-12" id="blk_mobile"></dd>
                            <dt class="col-sm-12">Occupation</dt>
                            <dd class="col-sm-12" id="blk_occupation"></dd>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <dt class="col-sm-12">Permanent Address</dt>
                    <dd class="col-sm-12" id="blk_permanent"></dd>
                    <dt class="col-sm-12">Current Address Address</dt>
                    <dd class="col-sm-12" id="blk_current"></dd>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"  data-dismiss="modal" aria-label="Close" id="block_no">Close</button>
                <button type="button" class="btn btn-primary" id="view_edit"><i class="fa fa-edit"></i> Edit</button>
            </div>
        </diV>
    </div>
</div>
<div class="modal fade" id="filter_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" id="change-update" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fltr_title">Generate Information</h5>
                <button type="button" class="close text-danger cls-update-modal" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Do you want to generate information with current selected advance filter?</p>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">  
                        <div class="row">
                            <dt class="col-sm-6 col-12" id="fltr_l_Gender">Gender</dt>
                            <dd class="col-sm-6 col-12" id="fltr_gender"></dd>
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <dt class="col-sm-6 col-12" id="fltr_l_Verify">Verification</dt>
                            <dd class="col-sm-6 col-12" id="fltr_verify"></dd>
                        </div>
                    </div>
                    
                    
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h5 id="fltr_t_per">Permanent Address</h5>
                        <div class="row">
                        <dt class="col-sm-6 col-12" id="fltr_l_pProve">Province</dt>
                        <dd class="col-sm-6 col-12 fltr" id="fltr_pProv"></dd>
                        <dt class="col-sm-6 col-12" id="fltr_l_pMuni">Municipality</dt>
                        <dd class="col-sm-6 col-12 fltr" id="fltr_pMuni"></dd>
                        <dt class="col-sm-6 col-12" id="fltr_l_pBrgy">Barangay</dt>
                        <dd class="col-sm-6 col-12" id="fltr_pBrgy"></dd>
                        <dt class="col-sm-6 col-12" id="fltr_l_pZone">Zone</dt>
                        <dd class="col-sm-6 col-12" id="fltr_pZone"></dd>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h5 id="fltr_t_cur">Current Address</h5>
                        <div class="row">
                        <dt class="col-sm-6 col-12" id="fltr_l_cProv">Province</dt>
                        <dd class="col-sm-6 col-12 fltr" id="fltr_cProv"></dd>
                        <dt class="col-sm-6 col-12" id="fltr_l_cMuni">Municipality</dt>
                        <dd class="col-sm-6 col-12 fltr" id="fltr_cMuni"></dd>
                        <dt class="col-sm-6 col-12" id="fltr_l_cBrgy">Barangay</dt>
                        <dd class="col-sm-6 col-12" id="fltr_cBrgy"></dd>
                        <dt class="col-sm-6 col-12" id="fltr_l_cZone">Zone</dt>
                        <dd class="col-sm-6 col-12" id="fltr_cZone"></dd>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" aria-label="Close" id="fltr_No">No</button>
                <button type="button" class="btn btn-primary" id="fltr_Yes">Yes</button>
            </div>
        </diV>
    </div>
</div>

<div class="toast" id="field-toast" data-delay="3000">
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
<div class="toast" id="change-toast" data-delay="3000">
    <div class="toast-header bg-info text-white">
        <strong class="mr-auto">Information</strong>
        <small>just now</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        Noting to update on the citizen information.
    </div>
</div>
<div class="toast" id="update-toast" data-delay="3000">
    <div class="toast-header bg-success text-white">
        <strong class="mr-auto">Success</strong>
        <small>just now</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        You've successfully updated citizens information.
    </div>
</div>
<div class="toast" id="updateError-toast" data-delay="3000">
    <div class="toast-header bg-danger text-white">
        <strong class="mr-auto">Error</strong>
        <small>just now</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        System detect another person exist on the server.
    </div>
</div>
<div class="toast" id="block-toast" data-delay="3000">
    <div class="toast-header bg-success text-white">
        <strong class="mr-auto">Success</strong>
        <small>just now</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        You've successfully updated citizens verification.
    </div>
</div>
<div class="toast" id="blockError-toast" data-delay="3000">
    <div class="toast-header bg-danger text-white">
        <strong class="mr-auto">Error</strong>
        <small>just now</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        The system encounter an error, Please try again later.
    </div>
</div>
<div class="toast" id="generateError-toast" data-delay="3000">
    <div class="toast-header bg-danger text-white">
        <strong class="mr-auto">Error</strong>
        <small>just now</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        Noting to generate citizen information on selected advance filter.
    </div>
</div>
<div class="toast" id="generate-toast" data-delay="3000">
    <div class="toast-header bg-info text-white">
        <strong class="mr-auto">Information</strong>
        <small>just now</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        Successfully generated the citizen information. Please wait download will start shortly.
    </div>
</div>
@endsection