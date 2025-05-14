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
<script src="{{ asset('js/ContactTracer/ctc_facility.js') }}"></script>
@endsection

@section('content')


<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Others / <span class="add-title">Facility</span></h1>
</div>

<div class="row">
    <div class="col xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="row">
                    <h3 class="m-0 font-weight-bold text-primary">List of Facility</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-center justify-content-sm-start">
                    <button type="button" class="btn btn-primary ml-3 mb-3" data-toggle="modal" data-target="#add_modal"><i class="far fa-plus-square"></i> Add New</button>
                </div>
                
                <div class="table-responsive">
                    <table id="facility_info"  class="table table-hover cell-border dt-responsive" cellspacing="0" width="100%">
                        <thead class="text-white"> 
                            <tr>
                                <th>#</th>
                                <th>Facility Name</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection