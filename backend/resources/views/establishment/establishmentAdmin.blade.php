@extends('layout.layout_registration')

@section('title', 'Establishment Admin Form')

@section('content')

<section id="establishmentAdmin">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 text-center">
                <h1 class="mt-3">COVID-19 Contact Tracing Libmanan</h1>
                <h3 class="form_sub_title_registration">Step 2 of 4 : User Information</h3>
            </div>
        </div>

        <div class="row justify-content-center mt-2 mb-5">
            <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12 col-12 form-columns">

                <h3 class="">Personal Information</h3>

                <form id="formNoId" class="IdCheck">
                    <div class="form-group">
                        <input type="text" class="form-control" id="establishmentName" autocomplete="off" placeholder="e.g (Jay Mark A. Borja">
                        <label for="establishmentName">Full name</label>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="establishmentName" autocomplete="off" placeholder="e.g (Guard)">
                        <label for="establishmentName">Position</label>
                    </div>

                    <div class="form-group">
                        <select id="gender" class="form-control" equired autocomplete="off">
                            <option selected="" hidden=""> </option>
                            <option value="January">Male</option>
                            <option value="February">Female</option>
                        </select>
                        <label for="gender">Gender</label>
                    </div>

                    <p class="mb-2">Birthday</p>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-5 col-sm-5 col-4">
                            <div class="form-group">
                                <select id="month" class="form-control" equired autocomplete="off">
                                    <option selected="" hidden=""> </option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                                <label for="month">Month</label>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-4">
                            <div class="form-group">
                                <input type="text" class="form-control" id="day" autocomplete="off" placeholder="20" maxlength="2">
                                <label for="day">Day</label>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-4">
                            <div class="form-group">
                                <input type="text" class="form-control" id="Year" autocomplete="off" placeholder="1999"
                                 maxlength="4">
                                <label for="Year">Year</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="mobile" autocomplete="off" placeholder="e.g (095142927878)">
                        <label for="mobile">Mobile Number</label>
                    </div>  

                    <h3 class="mt-4">Sign in Information</h3>

                    <div class="form-group">
                        <input type="text" class="form-control" id="zone" autocomplete="off">
                        <label for="zone">Username</label>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="zone" autocomplete="off">
                        <label for="zone">Password</label>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="zone" autocomplete="off">
                        <label for="zone">Confirm Password</label>
                    </div>

                
                    <a href="/establishment/verification" class="btn btn-primary btn-block">NEXT</a>
                    

                </form>
            </div>
        </div>
    </div>
</section>
    
@endsection