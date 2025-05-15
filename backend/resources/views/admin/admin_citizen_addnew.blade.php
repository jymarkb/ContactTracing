@extends('layouts.layout_admin')

@section('title', 'Citizen / Add New')


@section('css-import')
<link href="{{ asset('css/styleRegistration.css') }}" rel="stylesheet">
<link href="{{ asset('css/AdminCSS/admin.css') }}" rel="stylesheet">
@endsection

@section('js-import-add')
<script src="{{ asset('js/Admin/admin-citizen-addnew.js') }}"></script>
<script src="{{ asset('js/Admin/admin.js') }}"></script>

@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Citizen / <span class="add-title">Add New</span></h1>
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
        You've successfully added a citizen.
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
        The citizen is existed in the system.
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

<div class="toast" style="" id="add-toast" data-delay="3000">
    <div class="toast-header bg-info text-white">
        <strong class="mr-auto">Information :</strong>
        <small>just now</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        Please wait citizens information is being save.
    </div>
</div>

<form method="POST" enctype="multipart/form-data" id="citizen-add" action="javascript:void(0)" >

    @csrf
    
    <div class="row p-0">
        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h3 class="mb-0 mt-1 font-weight-bold text-primary">Personal Information</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <input type="text" class="form-control " id="firstName" required autocomplete="off" placeholder="e.g (Jay Mark)" name="first" maxlength="20">
                        <label class="lblForm" for="firstName" >First Name</label>
                        <div id="validFirst" class="invalid-feedback">Please fill the field with citizen's firstname (e.g Jay Mark)</div>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="middleName" required autocomplete="off" placeholder="(e.g: Aureus)" name="middle" maxlength="20"> 
                        <label class="lblForm" for="middleName">Middle Name</label>
                        <div id="validMiddle" class="invalid-feedback">Please fill the field with citizen's middle name (e.g Aureus)</div>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="lastName" required autocomplete="off" placeholder="(e.g: Borja)" name="last" maxlength="20">
                        <label class="lblForm" for="lastName">Last Name</label>
                        <div id="validLast" class="invalid-feedback">Please fill the field with citizen's lastname (e.g Borja)</div>
                    </div>

                    <p class="mb-2 text-dark"><strong>Suffix</strong></p>
                    <div class="form-group">
                        <select id="suffix" class="form-control" required autocomplete="off" name="suffix">
                            <option value="0">none</option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                            <option value="V">V</option>
                            <option value="JR">JR</option>
                            <option value="SR">SR</option>
                        </select>
                        <small id="suffixHelp" class="form-text text-muted">Please fill the field with citizen's suffix (I, II, JR, SR).Optional if you don't have.</small>
                    </div>


                    <p class="mb-2 text-dark"><strong>Birthday</strong></p>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-5 col-sm-5 col-4">
                            <div class="form-group">
                                <select id="month" class="form-control" required autocomplete="off" name="month">
                                    <option selected="" value="0" hidden=""> </option>
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
                                <label class="lblForm" for="month">Month</label>
                                <div id="validMonth" class="invalid-feedback">Please select citizen's birth month.</div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-4">
                            <div class="form-group">
                                <input type="number" class="form-control" id="day" required autocomplete="off" placeholder="DD" name="day" maxlength="2">
                                <label class="lblForm" for="day">Day</label>
                                <div id="validMonth" class="invalid-feedback">Please fill citizen's birth day. (e.g 20)</div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-4">
                            <div class="form-group">
                                <input type="number" class="form-control" id="year" required autocomplete="off" placeholder="YYYY" name="year" maxlength="4">
                                <label class="lblForm" for="year">Year</label>
                                <div id="validMonth" class="invalid-feedback">Please fill citizen's birth year. (e.g 1999)</div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="form-group">
                        <select id="gender" class="form-control" required autocomplete="off" name="gender">
                            <option value="0" selected hidden></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <label class="lblForm" for="gender">Gender</label>
                        <div id="validLast" class="invalid-feedback">Please select citizen's gender.</div>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="profession" required autocomplete="off" placeholder="(eg: Barbero, Teacher)" name="profession" maxlength="100">
                        <label class="lblForm" for="profession">Profession/Occupation</label>
                        <div id="validLast" class="invalid-feedback">Please fill the field with citizen's occupation (e.g Barbero, Teacher)</div>
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control" id="mobile" required autocomplete="off" placeholder="(e.g: 09XXXXXXXXX)" name="number" maxlength="11">
                        <label class="lblForm" for="mobile">Mobile Number</label>
                        <div id="validMobileA" class="invalid-feedback">Please fill the field with citizen's 11 digit mobile number (e.g 09XXXXXXXXX)</div>
                        <div id="validMobileB" class="invalid-feedback">Please enter mobile number not used in previous registration.</div>
                    </div>  

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="photo" required name="photo" accept="image/x-png,image/jpeg" >
                        <label class="custom-file-label text-truncate" for="photo" id="photo-label">Profile Photo (Choose file)</label>
                        <small id="suffixHelp" class="form-text text-muted">Please upload citizen's latest picture.</small>
                    </div>


                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h3 class="mb-0 mt-1 font-weight-bold text-primary">Permanent Address</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <select id="province" class="form-control address" required autocomplete="off" name="perProvince">
                            @foreach ($province as $province)
                            <option value="{{$province->province_id}}" @if($province->province_id == 20) selected @endif  >{{ ucwords(strtolower($province->province_name)) }}</option>
                            @endforeach
                        </select>
                        <label for="province" class='label-province active'>Province</label>
                        <div id="validFirst" class="invalid-feedback">Please select citizen's province.</div>
                    </div>

                    <div class="form-group">
                        <select id="municipality" class="form-control address" required autocomplete="off" name="perMunicipality">
                        
                        </select>
                        <label for="municipality" class='lblForm label-municipality'>City / Municipality</label>
                        <div id="validFirst" class="invalid-feedback">Please select citizen's municipality.</div>
                    </div>

                    <div class="form-group">
                        <select id="barangay" class="form-control" required  autocomplete="off" name="perBarangay">

                        </select>
                        <label for="barangay" class="lblForm label-barangay">Barangay</label>
                        <div id="validFirst" class="invalid-feedback">Please select citizen's barangay.</div>
                    </div>

                    <div class="form-group" id="zone_div_select">
                        <select id="zone" class="form-control" required autocomplete="off" name="perZone1">

                        </select>
                        <label for="zone" class="lblForm label-zone">Zone</label>
                        <div id="validFirst" class="invalid-feedback">Please select citizen's zone.</div>
                    </div>

                    <div class="form-group hidden" id="zone_div_field">
                        <input type="text" class="form-control" id="zone_field" autocomplete="off" placeholder="e.g Zone 1" name="perZone2">
                        <label for="zone_field" class="details-reg lblForm label-zone-field">Zone</label>
                        <div id="validFirst" class="invalid-feedback">Please fill the field with citizen's zone.</div>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="details" autocomplete="off" placeholder="e.g (2nd Flr, Building Name)" name="perBldg">
                        <label for="details" class="details-reg lblForm label-detail">House/Unit/Flr #, Bldg Name, Blk or Lot #</label>
                        <small id="suffixHelp" class="form-text text-muted">Optional if you don't have.</small>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header">
                    <h3 class="mb-0 mt-1 font-weight-bold text-primary">Current Address</h3>
                </div>
                <div class="card-body">
                    <div class="custom-control custom-checkbox mb-4">
                        <input type="checkbox" class="custom-control-input" id="chkCurrent">
                        <label class="custom-control-label" for="chkCurrent">My Permanent Address is my Current Address.</label>
                    </div>

                    <div class="pt-2" id="currentAddress">
                        <div class="form-group">
                            <select id="province_current" class="form-control" required autocomplete="off" name="curProvince">
                                @foreach ($curProvince as $curProvince)
                                <option value="{{$curProvince->province_id}}" @if($curProvince->province_id == 20) selected @endif>{{ ucwords(strtolower($curProvince->province_name)) }}</option>
                                @endforeach
                            </select>
                            <label for="province_current" class="label-curProvince active">Province</label>
                            <div id="validFirst" class="invalid-feedback">Please select citizen's current province.</div>
                        </div>

                        <div class="form-group">
                            <select id="municipality_current" class="form-control" required autocomplete="off" name="curMunicipality">
                                <option value="0" selected hidden=""> </option>
                                
                            </select>
                            <label for="municipality_current" class="lblForm label-curMunicipality">City / Municipality</label>
                            <div id="validFirst" class="invalid-feedback">Please select citizen's current municipality.</div>
                        </div>

                        <div class="form-group">
                            <select id="barangay_current" class="form-control" required autocomplete="off" name="curBarangay">
                                <option value="0" selected hidden=""> </option>
                                
                            </select>
                            <label for="barangay_current" class="lblForm label-curBarangay">Barangay</label>
                            <div id="validFirst" class="invalid-feedback">Please select citizen's current barangay.</div>
                        </div>

                        <div class="form-group" id="zone_div_select_current">
                            <select id="zone_current" class="form-control" required autocomplete="off" name="curZone1">
                                <option value="0" selected hidden=""> </option>

                            </select>
                            <label for="zone_current" class="lblForm label-curZone">Zone</label>
                            <div id="validFirst" class="invalid-feedback">Please select citizen's current zone.</div>
                        </div>

                        <div class="form-group hidden" id="zone_div_field_current">
                            <input type="text" class="form-control " id="zone_field_current" autocomplete="off" placeholder="e.g Zone 1" name="curZone2">
                            <label for="zone_field_current" class="details-reg lblForm label-curZone-field">Zone</label>
                            <div id="validFirst" class="invalid-feedback">Please fill the field with citizen's current zone.</div>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="details_current" autocomplete="off" placeholder="e.g (2nd Flr, Building Name)" name="curBldg">
                            <label for="details_current" class="details-reg lblForm label-curDetail">House/Unit/Flr #, Bldg Name, Blk or Lot #</label>
                            <small id="suffixHelp" class="form-text text-muted">Optional if you don't have.</small>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-4 mb-2">
        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
            <button type="submit" id="adminCitizenAdd" class="btn btn-primary btn-lg btn-block">Add New Citizen</button>
        </div>
    </div>

</form>

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
        The admin information is existed in the system.
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
        You've successfully added a admin account.
    </div>
</div>




@endsection