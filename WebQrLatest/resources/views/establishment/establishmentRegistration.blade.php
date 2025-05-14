@extends('layout.layout_registration')

@section('title', 'Establishment Registration Form')

@section('content')

<section id="establishmentInfo">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 text-center">
                <h1 class="mt-3">COVID-19 Contact Tracing Libmanan</h1>
                <h3 class="form_sub_title_registration">Step 1 of 4 : Establishment</h3>
            </div>
        </div>

        <div class="row justify-content-center mt-2 mb-5">
            <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12 col-12 form-columns">

                <h3 class="">Establishment Information</h3>

                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" id="establishmentName" autocomplete="off">
                        <label for="establishmentName">Company Name</label>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="establishmentName" autocomplete="off">
                        <label for="establishmentName">Mayor's Permit</label>
                    </div>

                    <div class="form-group">
                        <select id="brgy" class="form-control" equired autocomplete="off">
                            <option selected="" hidden=""> </option>
                            <option value="January">Filipino (Native Filipino)</option>
                            <option value="February">Foreigner (e.g: American)</option>
                        </select>
                        <label for="brgy">Barangay.</label>
                    </div>

                    <div class="form-group">
                        <select id="zone" class="form-control" equired autocomplete="off">
                            <option selected="" hidden=""> </option>
                            <option value="January">Filipino (Native Filipino)</option>
                            <option value="February">Foreigner (e.g: American)</option>
                        </select>
                        <label for="zone">Zone</label>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="completeAddress" autocomplete="off">
                        <label for="completeAddress">Complete Address</label>
                    </div>

                    <a href="/establishment/admin" class="btn btn-primary btn-block">NEXT</a>
                    

                </form>
            </div>
        </div>
    </div>
</section>
    
@endsection