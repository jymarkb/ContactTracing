@extends('cbsua.layout')

@section('title', '- About')

@section('import')
    <script src="{{ asset('js/cbsua/cbsua.js') }}"></script>
@endsection

@section('content')

<div class="row mt-5">
    <div class="col-xl-12 text-center">
        <h2 class="mt-3" id="titleTop">Central Bicol State University Tracing App</h2>
        <h3 class="form_sub_title_registration">Teams and Conditions</h3>
    </div>
</div>

<div class="row justify-content-center mt-3 mb-5">
    <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-11">
        <div class="card shadow border-0">
            <div class="card-body p-md-5 p-4">
                <div class="form-group">
                    <h4 class="text-center m-0 mt-2 mb-2">Please read Teams and Conditions</h4>
                    <textarea class="form-control text-left border-0 bg-white" disabled rows="10" id="eluaText">
                    These Terms and Conditions constitute a legally binding agreement made between you, whether personally or on behalf of "You" and CBSUA – Tracing App we concerning your access to and use of the CBSUA -Tracing App website as well as any other media form, media channel, mobile website or mobile application related, linked, or otherwise connected thereto.
                    
                    You agree that by accessing the Site, you have read, understood, and agree to be bound by all of these Terms and Conditions. If you do not agree with all of these Terms and Conditions, then you are expressly prohibited from using the Site and you must discontinue use immediately.Supplemental terms and conditions or documents that may be posted on the Site from time to time are hereby expressly incorporated herein by reference. We reserve the right, in our sole discretion, to make changes or modifications to these Terms and Conditions at any time and for any reason.

                    We will alert you about any changes by updating the “Last updated” date of these Terms and Conditions, and you waive any right to receive specific notice of each such change.It is your responsibility to periodically review these Terms and Conditions to stay informed of updates. You will be subject to, and will be deemed to have been made aware of and to have accepted, the changes in any revised Terms and Conditions by your continued use of the Site after the date such revised Terms and Conditions are posted.
                    
                    The information provided on the Site is not intended for distribution to or use by any person or entity in any jurisdiction or country where such distribution or use would be contrary to law or regulation or which would subject us to any registration requirement within such jurisdiction or country.Accordingly, those persons who choose to access the Site from other locations do so on their own initiative and are solely responsible for compliance with local laws, if and to the extent local laws are applicable.
                    
                    In order to resolve a complaint regarding the Site or to receive further information regarding use of the Site, please contact us at: Email : jaymark.borja@cbsua.edu.ph; Contact # : 09514292787; Facebook : www.facebook.com/mackyhoho
                    </textarea>
                </div>


                <div class="custom-control custom-checkbox mb-4">
                    <input type="checkbox" class="custom-control-input" id="chkAgree">
                    <label class="custom-control-label" for="chkAgree">I understand the Terms and Conditions<i class="checkRequired"></i></label>
                    <div id="validFirst" class="invalid-feedback mt-2">Please check Terms and Conditions</div>
                </div>

                <button type="button" class="btn btn-primary btn-block next-eula-btn" id="nextEula">Next</button>

                <!-- <a href="/register/form" class="btn btn-primary btn-block next-eula-a">Next</a> -->
            
            </div>
        </div> 
    </div>
</div>


@endsection

