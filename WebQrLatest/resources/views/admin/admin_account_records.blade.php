@extends('layouts.layout_admin')

@section('title', 'Admin / Records')

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
<script src="{{ asset('js/Admin/admin-account-dt.js') }}"></script>
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Admin / <span class="add-title">Records</span></h1>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-xl-9 col-lg-8 col-md-7 col-sm-12 col-12 mb-3 mb-md-0">
                        <h3 class="m-0 font-weight-bold text-primary">Admin Table</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="user_info"  class="table table-hover cell-border dt-responsive" cellspacing="0" style="width:100%">
                        
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
                                <th>Username</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table >
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="ac_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" id="modal-ac" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Account Information</h5>
            <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form enctype="multipart/form-data" id="acUpdate" action="javascript:void(0)" class="row">
                @csrf
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 form-dt">
                <h5>User Information</h5>
                    <div class="row">
                        <dt class="col-sm-12 edt_ct_lbl">First Name</dt>
                        <dd class="col-sm-12">
                            <input type="text" class="form-control " id="u_fname" autocomplete="off" placeholder="e.g (Jay Mark)" name="u_fname" maxlength="20">
                            <div id="validFirst" class="invalid-feedback">Please fill the field with firstname (e.g Jay Mark)</div>
                        </dd>

                        <dt class="col-sm-12 edt_ct_lbl">Middle Name</dt>
                        <dd class="col-sm-12">
                            <input type="text" class="form-control" id="u_mname" autocomplete="off" placeholder="(e.g: Aureus)" name="u_mname" maxlength="20"> 
                            <div id="validMiddle" class="invalid-feedback">Please fill the field with middle name (e.g Aureus)</div>
                        </dd>

                        <dt class="col-sm-12 edt_ct_lbl">Last Name</dt>
                        <dd class="col-sm-12">
                            <input type="text" class="form-control" id="u_lname" autocomplete="off" placeholder="(e.g: Borja)" name="u_lname" maxlength="20">
                            <div id="validLast" class="invalid-feedback">Please fill the field with lastname (e.g Borja)</div>
                        </dd>

                        <dt class="col-sm-12">Suffix</dt>
                        <dd class="col-sm-12">
                            <select id="u_suffix" class="form-control" equired autocomplete="off" name="u_suffix">
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
                        </dd>

                        <dt class="col-sm-12 edt_ct_lbl">Gender</dt>
                        <dd class="col-sm-12">
                            <select id="u_gender" class="form-control" equired autocomplete="off" name="u_gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <div class="invalid-feedback">Please select gender.</div>
                        </dd>

                        <dt class="col-sm-12 edt_ct_lbl">Birth Day</dt>
                        <dd class="col-sm-12">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-5 col-sm-5 col-4">
                                    <div class="form-group">
                                        <label class="lblForm small m-0" id="es_lblmonth"  for="u_month">Month</label>
                                        <select id="u_month" class="form-control" equired autocomplete="off" name="u_month">
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
                                        <div class="invalid-feedback">Please select birth month.</div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-4">
                                    <div class="form-group">
                                        <label class="lblForm small m-0" id="es_lblday"  for="u_day">Day</label>
                                        <input type="number" class="form-control" id="u_day" autocomplete="off" placeholder="DD" name="u_day" maxlength="2">
                                        <div id="validMonth" class="invalid-feedback">Please fill birth day. (e.g 20)</div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-4">
                                    <div class="form-group">
                                        <label class="lblForm small m-0" id="es_lblyear"  for="u_year">Year</label>
                                        <input type="number" class="form-control" id="u_year" autocomplete="off" placeholder="YYYY" name="u_year" maxlength="4">
                                        <div id="validMonth" class="invalid-feedback">Please fill birth year. (e.g 1999)</div>
                                    </div>
                                </div>
                            </div>
                        </dd>

                        <dt class="col-sm-12 edt_ct_lbl">Mobile Number</dt>
                        <dd class="col-sm-12">
                            <input type="number" class="form-control" id="u_number" autocomplete="off" placeholder="(e.g: 09XXXXXXXXX)" name="u_number" maxlength="11">
                            <div id="validMobileA" class="invalid-feedback">Please fill the field with 11 digit mobile number (e.g 09XXXXXXXXX)</div>
                            <div id="validMobileB" class="invalid-feedback">Please enter mobile number not used in previous registration.</div>
                        </dd>
                    </div>

                    <h5 class="mt-md-3">Login Information</h5>
                    <div class="row">
                        <dt class="col-sm-12 edt_ct_lbl user-row">Username</dt>
                        <dd class="col-sm-12 user-row">
                            <input type="text" autocomplete="off" class="form-control" id="u_username"  placeholder="e.g (Jollibee)" name="u_username" maxlength="20">
                            <div id="userA" class="invalid-feedback">Please fill the field with username. (e.g Jollibee)</div>
                            <div id="userB" class="invalid-feedback">Please fill the field with not used username(e.g Jollibee)</div>
                        </dd>
                        <dt class="col-sm-12 edt_ct_lbl">Account Type</dt>
                        <dd class="col-sm-12">
                            <select id="u_type" class="form-control" equired autocomplete="off" name="u_type">
                                <option value="1">Admin</option>
                                <option value="2">Misu</option>
                                <option value="3">Contact Tracer</option>
                                <option value="4">Establishment</option>
                            </select>
                            <div class="invalid-feedback">Please select account type.</div>
                        </dd>
                    </div>


                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="ac_update_cancel">Close</button>
            <button type="button" class="btn btn-primary" id="ac_update_save">Save changes</button>
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
                <p class="m-0">Do you want to save the change(s) for this account?</p>
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
                <p class="m-0">Do you want to save the change(s) for this account?</p>
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

                        <div class="row" id="row-mobile">
                            <dt class="col-sm-12">Mobile</dt>
                            <dd class="col-sm-12">
                                <p class="m-0 text-danger"><strong><span class="fa fa-times"></span></strong> &nbspold : <span id="mobileOld"></span></p>
                                <p class="m-0 text-success"><strong><span class="fa fa-check"></span></strong> new : <span id="mobileNew"></span></p>
                            </dd>
                        </div>

                        <div class="row" id="row-username">
                            <dt class="col-sm-12">Username</dt>
                            <dd class="col-sm-12">
                                <p class="m-0 text-danger"><strong><span class="fa fa-times"></span></strong> &nbspold : <span id="usernameOld"></span></p>
                                <p class="m-0 text-success"><strong><span class="fa fa-check"></span></strong> new : <span id="usernameNew"></span></p>
                            </dd>
                        </div>

                        <div class="row" id="row-type">
                            <dt class="col-sm-12">Account Type</dt>
                            <dd class="col-sm-12">
                                <p class="m-0 text-danger"><strong><span class="fa fa-times"></span></strong> &nbspold : <span id="typeOld"></span></p>
                                <p class="m-0 text-success"><strong><span class="fa fa-check"></span></strong> new : <span id="typeNew"></span></p>
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Account Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center mb-3">
                    <div class="col-xl-8 col-lg-7 col-md-7 col-sm-7 col-8 text-center">
                        <img class="w-75 rounded-circle" alt="profile" id="v_profile">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-11 col-lg-11 col-md-11 col-sm-11 col-11">
                        <h4>Login Information</h4>
                        <hr class="mt-0 sidebar-divider">
                        <div class="row mb-3">
                            <dt class="col-sm-4 col-5">Username</dt>
                            <dd class="col-sm-8 col-7" id="v_username"></dd>
                            <dt class="col-sm-4 col-5">Type</dt>
                            <dd class="col-sm-8 col-7" id="v_type"></dd>
                            <dt class="col-sm-4 col-5" id="v_lblCompany">Company</dt>
                            <dd class="col-sm-8 col-7" id="v_company"></dd>
                        </div>

                        <h4>User Information</h4>
                        <hr class="mt-0 sidebar-divider">
                        <div class="row">
                            <dt class="col-sm-4 col-5">Name</dt>
                            <dd class="col-sm-8 col-7" id="v_name"></dd>
                            <dt class="col-sm-4 col-5">Gender</dt>
                            <dd class="col-sm-8 col-7" id="v_gender"></dd>
                            <dt class="col-sm-4 col-5">Age</dt>
                            <dd class="col-sm-8 col-7" id="v_age"></dd>
                            <dt class="col-sm-4 col-5">Birth Day</dt>
                            <dd class="col-sm-8 col-7" id="v_bday"></dd>
                            <dt class="col-sm-4 col-5">Mobile #</dt>
                            <dd class="col-sm-8 col-7" id="v_number"></dd>
                        </div>
                    </div>
                   

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="v_edit">Edit</button>
            </div>
        </div>
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
        Noting to update in the account information.
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
        System detect another account exist on the server.
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
        You've successfully updated account information.
    </div>
</div>

@endsection