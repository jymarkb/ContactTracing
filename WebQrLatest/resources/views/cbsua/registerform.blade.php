@extends('cbsua.layout')

@section('title', '- Registration Form')

@section('import')
    <script src="{{ asset('js/cbsua/cbsua.js') }}"></script>
    <script src="{{ asset('js/cbsua/registration.js') }}"></script>
@endsection


@section('content')

<div class="row mt-5">
    <div class="col-xl-12 text-center">
        <h1 class="mt-3" id="titleTop">Central Bicol State University Tracing App</h1>
        <h3 class="form_sub_title_registration">Registration Form</h3>
    </div>
</div>

<div class="row justify-content-center mt-3">
    <div class="col-xl-8 col-lg-10 col-md-10 col-sm-10 col-12">
        <div class="card shadow border-0">
            <div class="card-body">
                <form class="row" method="POST" enctype="multipart/form-data" id="citizen-new" action="javascript:void(0)">
                    @csrf
                    <div class="col-xl-12 p-4 p-md-5 titleForm">
                        <div class="alert alert-danger d-none" style="font-size:90%" id="requiredAll">
                            <strong> <i class="fa fa-exclamation-triangle"></i> Error! </strong>Please fill with your information all require(*) fields.
                        </div>

                        <h4 class="">Personal Information <span class="text-danger small">* Required</span></h4>

                        <div class="form-group mt-3">
                            <input type="text" class="form-control " id="firstName"  required autocomplete="off" placeholder="e.g (Jay Mark)" name="first" maxlength="20">
                            <label for="firstName" on>First Name</label>
                            <div id="validFirst" class="invalid-feedback">Please fill the field with your firstname (e.g Jay Mark)</div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="middleName" required autocomplete="off" placeholder="(e.g: Aureus)" name="middle" maxlength="20"> 
                            <label for="middleName">Middle Name</label>
                            <div id="validMiddle" class="invalid-feedback">Please fill the field with your middle name (e.g Aureus)</div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="lastName" required autocomplete="off" placeholder="(e.g: Borja)" name="last" maxlength="20">
                            <label for="lastName">Last Name</label>
                            <div id="validLast" class="invalid-feedback">Please fill the field with your lastname (e.g Borja)</div>
                        </div>
                        
                        <!-- <p class="mb-2 text-dark"><strong>Suffix</strong></p> -->
                        <div class="form-group">
                            <select id="suffix" class="form-control " required autocomplete="off" name="suffix">
                                <option value="0">none</option>
                                <option value="I">I</option>
                                <option value="II">II</option>
                                <option value="III">III</option>
                                <option value="IV">IV</option>
                                <option value="V">V</option>
                                <option value="JR">JR</option>
                                <option value="SR">SR</option>
                            </select>
                            <label class="active details-reg" id="lblSuffix" for="suffix">Suffix</label>
                            <small id="suffixHelp" class="form-text text-muted">Please fill the field with your suffix (I, II, JR, SR).Optional if you don't have.</small>
                        </div>

                        <p class="mb-2 text-dark"><strong>Birthday</strong></p>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-5 col-sm-5 col-12">
                                <div class="form-group">
                                    <select id="month" class="form-control" required autocomplete="off" name="month">
                                        <option selected value="0" hidden disabled></option>
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
                                    <label for="month" id="lblMonth">Month</label>
                                    <div id="validMonth" class="invalid-feedback">Please select your birth month.</div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="day" required autocomplete="off" placeholder="DD" name="day" maxlength="2">
                                    <label for="day">Day</label>
                                    <div id="validMonth" class="invalid-feedback">Please fill your birth day. (e.g 20)</div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-6">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="year" required autocomplete="off" placeholder="YYYY" name="year" maxlength="4">
                                    <label for="year">Year</label>
                                    <div id="validMonth" class="invalid-feedback">Please fill your birth year. (e.g 1999)</div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="form-group">
                            <select id="gender" class="form-control" required autocomplete="off" name="gender">
                                <option selected value="0" hidden disabled></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <label for="gender" id="lblGender">Gender</label>
                            <div id="validLast" class="invalid-feedback">Please select your gender.</div>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="profession" required autocomplete="off" placeholder="(eg: Barbero, Teacher)" name="profession" maxlength="100">
                            <label for="profession">Profession/Occupation</label>
                            <div id="validLast" class="invalid-feedback">Please fill the field with your occupation (e.g Barbero, Teacher)</div>
                        </div>

                        <div class="form-group">
                            <input type="number" class="form-control" id="mobile" required autocomplete="off" placeholder="(e.g: 09XXXXXXXXX)" name="number" maxlength="11">
                            <label for="mobile">Mobile Number</label>
                            <div id="validMobileA" class="invalid-feedback">Please fill the field with your 11 digit mobile number (e.g 09XXXXXXXXX)</div>
                            <div id="validMobileB" class="invalid-feedback">Please enter mobile number not used in previous registration.</div>
                        </div>


                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="photo" required name="photo" accept="image/jpg, image/jpeg, image/png" >
                            <label class="custom-file-label text-truncate" for="photo" id="photo-label">Profile Photo (Choose file)</label>
                            <small id="suffixHelp" class="form-text text-muted">Please upload your latest picture.</small>
                        </div>
                        <div class="row">
                            <img src="" alt="" id="profilePreview" class="d-none" width="150px" height="150px">
                        </div>

                        <h4 class="mt-4 mb-3">Permanent Address <span class="text-danger small">* Required</span></h4>
                        <div class="form-group">
                            <select id="province" class="form-control address" required autocomplete="off" name="perProvince">
                                @foreach ($province as $pr)
                                    <option value="{{$pr->province_id}}" @if($pr->province_id == 20) selected @endif  >{{ ucwords(strtolower($pr->province_name)) }}</option>
                                @endforeach
                            </select>
                            <label for="province" class='label-province active'>Province</label>
                            <div id="validFirst" class="invalid-feedback">Please select your province.</div>
                        </div>

                        <div class="form-group">
                            <select id="municipality" class="form-control address" required autocomplete="off" name="perMunicipality">
                                <option selected value="0" hidden disabled></option>
                                <option value="0" disabled>Loading please wait...</option>
                            </select>
                            <label for="municipality" id="lblMunicipality" class='label-municipality'>City / Municipality</label>
                            <div id="validFirst" class="invalid-feedback">Please select your municipality.</div>
                        </div>

                        <div class="form-group">
                            <select id="barangay" class="form-control" required  autocomplete="off" name="perBarangay">
                            </select>
                            <label for="barangay" id="lblBrgy" class="label-barangay">Barangay</label>
                            <div id="validFirst" class="invalid-feedback">Please select your barangay.</div>
                        </div>

                        <div class="form-group" id="zone_div_select">
                            <select id="zone" class="form-control" required autocomplete="off" name="perZone1">

                            </select>
                            <label for="zone" id="lblZone" class="label-zone">Zone</label>
                            <div id="validFirst" class="invalid-feedback">Please select your zone.</div>
                        </div>

                        <div class="form-group hidden" id="zone_div_field">
                            <input type="text" class="form-control" id="zone_field" autocomplete="off" placeholder="e.g Zone 1" name="perZone2">
                            <label for="zone_field" class="details-reg label-zone-field">Zone</label>
                            <div id="validFirst" class="invalid-feedback">Please fill the field with your zone.</div>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="details" autocomplete="off" placeholder="e.g (2nd Flr, Building Name)" name="perBldg">
                            <label for="details" class="details-reg label-bldg ">House/Unit/Flr #</label>
                            <small id="suffixHelp" class="form-text text-muted">Optional if you don't have.</small>
                        </div>

                        <h4 class="mt-4">Current Address <span class="text-danger small">* Required</span></h4>
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="chkCurrent">
                            <label class="custom-control-label lblAgree" for="chkCurrent">My Permanent Address is my Current Address.</label>
                        </div>

                        <div class="row mt-4" id="currentAddress">
                            <div class="col-xl-12" >
                                <div class="form-group">
                                    <select id="province_current" class="form-control" required autocomplete="off" name="curProvince">
                                        @foreach ($province as $pr)
                                            <option value="{{$pr->province_id}}" @if($pr->province_id == 20) selected @endif  >{{ ucwords(strtolower($pr->province_name)) }}</option>
                                        @endforeach
                                    </select>
                                    <label for="province_current" class="label-curProvince active">Province</label>
                                    <div id="validFirst" class="invalid-feedback">Please select your current province.</div>
                                </div>

                                <div class="form-group">
                                    <select id="municipality_current" class="form-control " required autocomplete="off" name="curMunicipality">
                                        <option selected value="0" hidden disabled> </option>
                                        <option value="0" disabled>Loading please wait...</option>
                                    </select>
                                    <label for="municipality_current" id="lblMuniCur" class="label-curMunicipality">City / Municipality</label>
                                    <div id="validFirst" class="invalid-feedback">Please select your current municipality.</div>
                                </div>

                                <div class="form-group">
                                    <select id="barangay_current" class="form-control" required autocomplete="off" name="curBarangay">
                                    </select>
                                    <label for="barangay_current" id="lblBrgyCur" class="label-curBarangay">Barangay</label>
                                    <div id="validFirst" class="invalid-feedback">Please select your current barangay.</div>
                                </div>

                                <div class="form-group" id="zone_div_select_current">
                                    <select id="zone_current" class="form-control" required autocomplete="off" name="curZone1">
                                        <option selected value="0" hidden disabled></option>

                                    </select>
                                    <label for="zone_current" id="lblZoneCur" class="label-curZone">Zone</label>
                                    <div id="validFirst" class="invalid-feedback">Please select your current zone.</div>
                                </div>

                                <div class="form-group hidden" id="zone_div_field_current">
                                    <input type="text" class="form-control" id="zone_field_current" autocomplete="off" placeholder="e.g Zone 1" name="curZone2">
                                    <label for="zone_field_current"  class="details-reg label-curZone-field">Zone</label>
                                    <div id="validFirst" class="invalid-feedback">Please fill the field with your current zone.</div>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" id="details_current" autocomplete="off" placeholder="e.g (2nd Flr, Building Name)" name="curBldg">
                                    <label for="details_current" class="details-reg label-curDetail">House/Unit/Flr #</label>
                                    <small id="suffixHelp" class="form-text text-muted">Optional if you don't have.</small>
                                </div>
                            </div>
                        </div>

                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="chkTerms">
                            <label class="custom-control-label lblAgree" for="chkTerms">I agree to CBSUA - Tracing App <a href="#">Terms of Use and Privacy Policy</a></label>
                        </div>

                        <div class="alert alert-danger d-none mb-5" style="font-size:90%" id="termsForm">
                            <strong> <i class="fa fa-exclamation-triangle"></i> Error! </strong>Please agree to all the terms and privacy policy before submitting information.
                        </div>

                        <button type="submit" id="submitForm" class="btn btn-lg btn-primary btn-block mt-5">NEXT</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalSpinner" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Uploading Information</h5>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <div class="spinner-border" style="width: 4rem; height: 4rem;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <p class="text-center">Please wait, this will take few minutes/seconds.</p>
            </div>
        </div>
    </div>
</div>

<a href="/register/verify" id="verifybtn" class="d-none">verify</a>

@endsection

