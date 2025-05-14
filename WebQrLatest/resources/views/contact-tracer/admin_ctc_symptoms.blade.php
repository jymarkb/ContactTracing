@extends('layouts.layout_admin')

@section('title', 'Symptoms / Add New')

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
<script src="{{ asset('js/ContactTracer/ctc_symptoms.js') }}"></script>
@endsection

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Others / <span class="add-title">Symptoms</span></h1>
</div>


<div class="row">
    <div class="col xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="row">
                    <h3 class="m-0 font-weight-bold text-primary">List of Symptoms</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-center justify-content-sm-start">
                    <button type="button" class="btn btn-primary ml-3 mb-3" data-toggle="modal" data-target="#add_modal"><i class="far fa-plus-square"></i> Add New</button>
                </div>
                
                <div class="table-responsive">
                    <table id="symptoms_info"  class="table table-hover cell-border dt-responsive" cellspacing="0" width="100%">
                        <thead class="text-white"> 
                            <tr>
                                <th>#</th>
                                <th>Symptom Name</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Symptom</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" id="symptom-new" action="javascript:void(0)">
                    @csrf
                    
                    <div class="form-group">
                        <label class="edt_ct_lbl" for="sname">Symptoms Name </label>
                        <input type="text" class="form-control" id="sname" name="sname">
                        <div class="invalid-feedback">Please fill the field.</div>
                    </div>

                    



                </form>
                
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="add-new">Add New</button>
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
<div class="toast" id="update-toast" data-delay="3000">
    <div class="toast-header bg-success text-white">
        <strong class="mr-auto">Success</strong>
        <small>just now</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        You've successfully added new symptoms.
    </div>
</div>

@endsection