@extends('layouts.layout_admin')

@section('title', 'Establishment / Records')

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
<script src="{{ asset('js/Admin/admin-es-dt.js') }}"></script>
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Establishment / <span class="add-title">Records</span></h1>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-xl-9 col-lg-8 col-md-7 col-sm-12 col-12 mb-3 mb-md-0">
                        <h3 class="m-0 font-weight-bold text-primary">Establishment Table</h3>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-5 col-sm-12 col-12 d-flex  justify-content-md-end">
                        <!-- <button class="btn btn-sm btn-primary shadow-sm" id="generateInfo">
                            <i class="fas fa-download fa-sm text-white-50"></i> Generate Information
                        </button> -->
                        <!-- <a href="/download/es/information" class="btn btn-sm btn-primary shadow-sm" id="downloadES">
                            <i class="fas fa-download fa-sm text-white-50"></i> Generate Information
                        </a> -->
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="establishment_info"  class="table table-hover cell-border dt-responsive" cellspacing="0" style="width:100%">
                        
                        <thead class="text-white"> 
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Owner</th>
                                <th>Middle</th>
                                <th>Last</th>
                                <th>Suffix</th>
                                <th>Permit #</th>
                                <th>Address</th>
                                <th>zone</th>
                                <th>PIN</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                    </table >
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="es_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog  modal-xl" id="modal-es" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Establishment Information</h5>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" id="esUpdate" action="javascript:void(0)" class="row">
            @csrf
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 form-dt">
                <h5>Owner</h5>
                <dt class="col-sm-12 edt_ct_lbl">First Name</dt>
                <dd class="col-sm-12">
                    <input type="text" class="form-control" autocomplete="off" placeholder="e.g (Jay Mark)" id="es_fname" name="es_fname">
                    <div id="validFirst" class="invalid-feedback">Please fill the field with owner firstname (e.g Jay Mark)</div>
                </dd>
                <dt class="col-sm-12 edt_ct_lbl">Middle Name</dt>
                <dd class="col-sm-12">
                    <input type="text" class="form-control" autocomplete="off" placeholder="(e.g: Aureus)" id="es_mname" name="es_mname">
                    <div id="validMiddle" class="invalid-feedback">Please fill the field with owner middle name (e.g Aureus)</div>
                </dd>
                <dt class="col-sm-12 edt_ct_lbl">Last Name</dt>
                <dd class="col-sm-12">
                    <input type="text" class="form-control" autocomplete="off" placeholder="(e.g: Borja)" id="es_lname" name="es_lname">
                    <div id="validLast" class="invalid-feedback">Please fill the field with owner lastname (e.g Borja)</div>
                </dd>
                <dt class="col-sm-12">Suffix</dt>
                <dd class="col-sm-12">
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
                    <small id="suffixHelp" class="form-text text-muted">Please fill the field with citizen suffix (I, II, JR, SR).Optional if you don't have.</small>
                </dd>
                <dt class="col-sm-12 mt-2 edt_ct_lbl">Birth Day</dt>
                <dd class="col-sm-12">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-5 col-sm-5 col-4">
                            <div class="form-group">
                                <label id="lblMonth" class="small"  for="es_month">Month</label>
                                <select id="es_month" class="form-control" equired autocomplete="off" name="es_month">
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
                                <div id="validMonth" class="invalid-feedback">Please select owner birth month.</div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-4">
                            <div class="form-group">
                                <label id="lblDay" class="small" for="es_day">Day</label>
                                <input type="number" class="form-control" id="es_day" autocomplete="off" placeholder="DD" name="es_day" maxlength="2">
                                <div id="validMonth" class="invalid-feedback">Please fill owner birth day. (e.g 20)</div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-4">
                            <div class="form-group">
                                <label id="lblYear" class="small"  for="es_year">Year</label>
                                <input type="number" class="form-control" id="es_year" autocomplete="off" placeholder="YYYY" name="es_year" maxlength="4">
                                <div id="validMonth" class="invalid-feedback">Please fill owner birth year. (e.g 1999)</div>
                            </div>
                        </div>
                    </div>
                </dd>
                <dt class="col-sm-12 edt_ct_lbl">Gender</dt>
                <dd class="col-sm-12">
                    <select class="form-control" id="es_gender" name="es_gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <div id="validLast" class="invalid-feedback">Please select your owner gender.</div>
                </dd>
                <dt class="col-sm-12 edt_ct_lbl">Mobile Number</dt>
                <dd class="col-sm-12">
                    <input type="number" class="form-control" id="es_number" autocomplete="off" placeholder="(e.g: 09XXXXXXXXX)" name="es_number" maxlength="11">
                    <div id="validMobileA" class="invalid-feedback">Please fill the field with citizen 11 digit mobile number (e.g 09XXXXXXXXX)</div>
                    <div id="validMobileB" class="invalid-feedback">Please enter mobile number not used in previous registration.</div>
                </dd>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 form-dt">
                <h5>Establishment</h5>
                <dt class="col-sm-12 edt_ct_lbl">Name</dt>
                <dd class="col-sm-12">
                    <input type="text" class="form-control" autocomplete="off" placeholder="e.g (Jay Mark)" id="es_company" name="es_company">
                    <div id="validFirst" class="invalid-feedback">Please fill the field with establishment name (e.g Jay Mark)</div>
                </dd>
                <dt class="col-sm-12 edt_ct_lbl">Permit #</dt>
                <dd class="col-sm-12">
                    <input type="text" class="form-control" autocomplete="off" placeholder="(e.g: Aureus)" id="es_permit" name="es_permit">
                    <div id="validMiddle" class="invalid-feedback">Please fill the field with establishment permit # (e.g Aureus)</div>
                </dd>

                <h5 class="mt-md-3">Address</h5>

                <dt class="col-sm-12 edt_ct_lbl">Barangay</dt>
                <dd class="col-sm-12">
                    <select class="custom-select" id="es_brgy" name="es_brgy">
                    @foreach ($brgy as $br)
                        <option value="{{$br->barangays_id}}">{{ ucwords(strtolower($br->barangays_name)) }}</option>
                    @endforeach
                    </select>
                    <div id="validFirst" class="invalid-feedback">Please select your citizen barangay.</div>
                </dd>
                <dt class="col-sm-12 edt_ct_lbl" id="zone-select-edt-lbl-cur">Zone</dt>
                <dd class="col-sm-12" id="zone-select-edt-cur">
                    <select class="custom-select" id="es_zone" name="es_zone">
                        
                    </select>
                    <div id="validFirst" class="invalid-feedback">Please select your citizen zone.</div>
                </dd>

                <dt class="col-sm-12">House/Unit/Flr #, Bldg Name, Blk or Lot#</dt>
                <dd class="col-sm-12">
                    <input type="text" class="form-control" id="es_bldg" autocomplete="off" placeholder="(e.g: Building Name 2nd Floor)" name="es_bldg">
                    <small id="suffixHelp" class="form-text text-muted">Optional if you don't have.</small>
                </dd> 
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="es_update_cancel">Close</button>
        <button type="button" class="btn btn-primary" id="es_update_save">Save changes</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="change_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" id="change-update" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Save Change</h5>
                <button type="button" class="close text-danger cls-update-modal" id="change_close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="m-0">Do you want to save the change(s) for this establishment record?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="change_no">No</button>
                <button type="button" class="btn btn-primary" id="change_yes">Yes</button>
            </div>
        </diV>
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
                <p>Do you want to save the change for this establishment record?</p>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="row" id="row-name">
                            <dt class="col-sm-12">Owner Name</dt>
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

                        <div class="row" id="row-mobile">
                            <dt class="col-sm-12">Mobile</dt>
                            <dd class="col-sm-12">
                                <p class="m-0 text-danger"><strong><span class="fa fa-times"></span></strong> &nbspold : <span id="mobileOld"></span></p>
                                <p class="m-0 text-success"><strong><span class="fa fa-check"></span></strong> new : <span id="mobileNew"></span></p>
                            </dd>
                        </div>

                        <div class="row" id="row-company">
                            <dt class="col-sm-12">Company Name</dt>
                            <dd class="col-sm-12">
                                <p class="m-0 text-danger"><strong><span class="fa fa-times"></span></strong> &nbspold : <span id="companyOld"></span></p>
                                <p class="m-0 text-success"><strong><span class="fa fa-check"></span></strong> new : <span id="companyNew"></span></p>
                            </dd>
                        </div>

                        <div class="row" id="row-permit">
                            <dt class="col-sm-12">Permit #</dt>
                            <dd class="col-sm-12">
                                <p class="m-0 text-danger"><strong><span class="fa fa-times"></span></strong> &nbspold : <span id="permitOld"></span></p>
                                <p class="m-0 text-success"><strong><span class="fa fa-check"></span></strong> new : <span id="permitNew"></span></p>
                            </dd>
                        </div>

                        <div class="row" id="row-address">
                            <dt class="col-sm-12">Address</dt>
                            <dd class="col-sm-12">
                                <p class="m-0 text-danger"><strong><span class="fa fa-times"></span></strong> &nbspold : <span id="addressOld"></span></p>
                                <p class="m-0 text-success"><strong><span class="fa fa-check"></span></strong> new : <span id="addressNew"></span></p>
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


<div class="modal fade" id="view_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" id="view-modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Information</h5>
                <button type="button" class="close text-danger cls-update-modal" id="change_close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <h5>Establishment Information</h5>
                <hr class="mt-0 sidebar-divider">
                <div class="row mb-3">
                    <dt class="col-sm-4 col-5">Name</dt>
                    <dd class="col-sm-8 col-7" id="ves_esname"></dd>
                    <dt class="col-sm-4 col-5">Permit</dt>
                    <dd class="col-sm-8 col-7" id="ves_permit"></dd>
                    <dt class="col-sm-4 col-5">Address</dt>
                    <dd class="col-sm-8 col-7" id="ves_address"></dd>
                </div>

                <h5>Owner Information</h5>
                <hr class="mt-0 sidebar-divider">
                <div class="row mb-3">
                    <dt class="col-sm-4 col-5">Name</dt>
                    <dd class="col-sm-8 col-7" id="ves_owname"></dd>
                    <dt class="col-sm-4 col-5">Gender</dt>
                    <dd class="col-sm-8 col-7" id="ves_gender"></dd>
                    <dt class="col-sm-4 col-5">Age</dt>
                    <dd class="col-sm-8 col-7" id="ves_age"></dd>
                    <dt class="col-sm-4 col-5">Birthday</dt>
                    <dd class="col-sm-8 col-7" id="ves_bday"></dd>
                    <dt class="col-sm-4 col-5">Mobile No.</dt>
                    <dd class="col-sm-8 col-7" id="ves_mobile"></dd>
                </div>

                <h5>Login Information</h5>
                <hr class="mt-0 sidebar-divider">
                <div class="row mb-3">
                    <dt class="col-sm-4 col-5">Username</dt>
                    <dd class="col-sm-8 col-7" id="ves_username"></dd>
                    <dt class="col-sm-4 col-5">Pin</dt>
                    <dd class="col-sm-8 col-7" id="ves_pin"></dd>
                    <dt class="col-sm-4 col-5">Account Type</dt>
                    <dd class="col-sm-8 col-7" id="ves_type"></dd>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="ves_edit"><i class="fa fa-edit"></i> Edit</button>
            </div>

        </diV>
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
        System detect another establishment exist on the server.
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
        You've successfully updated establishment information.
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
        Noting to update in the establishment information.
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
@endsection