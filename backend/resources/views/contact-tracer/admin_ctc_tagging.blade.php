@extends('layouts.layout_admin')

@section('title', 'Symptoms / Add New')

@section('css-import')
<link href="{{ asset('css/AdminCSS/admin.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('css/dtCSS/datatables.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/dtCSS/responsive.dataTables.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/select2/select2.min.css') }}"/>
@endsection

@section('js-import-add')
<script type="text/javascript" src="{{ asset('js/dtJS/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dtJS/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dtJS/dataTables.select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/select2/select2.min.js') }}"></script>
<script src="{{ asset('js/Admin/admin.js') }}"></script>
<script src="{{ asset('js/ContactTracer/ctc_tagging.js') }}"></script>
@endsection

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">/ <span class="add-title">Tagging</span></h1>
</div>



<div class="row">
    <div class="col xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-xl-9 col-lg-8 col-md-7 col-sm-6 col-10">
                        <h3 class="m-0 font-weight-bold text-primary">Tag Citizen</h3>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6 col-2">
                        <div class="row justify-content-end">
                            <button class="btn btn-primary shadow-sm d-none d-sm-block btn-sm generateInfo">
                                <i class="fas fa-download fa-sm text-white-50"></i> Generate Information
                            </button>
                        </div>

                        <div class="row justify-content-end">
                            <button class="btn btn-primary shadow-sm d-block d-sm-none generateInfo">
                                <i class="fas fa-download fa-sm text-white-50"></i>
                            </button>
                        </div>


                        <a href="/download/nofilter/tagging" class="btn btn-sm d-none btn-primary shadow-sm" id="downloadNoFilter" >
                            <i class="fas fa-download fa-sm text-white-50"></i> Generate Information
                        </a>
                        
                        <a href="/download/filter/tagging" class="btn btn-sm d-none btn-primary shadow-sm" id="downloadFilter">
                            <i class="fas fa-download fa-sm text-white-50"></i> Generate Information
                        </a>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="alert alert-info alert-dismissible fade d-none" role="alert" id="postive-alert">
                <p class="m-0 p-0"> <span class=" m-0 spinner-border spinner-border-sm"> </span> The system is checking for other possible contact person.</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- <div class="row justify-content-center justify-content-sm-end">
                    <button type="button" class="btn btn-primary ml-3 mb-3" data-toggle="modal" data-target="#add_modal"><i class="far fa-plus-square"></i> Add New</button>
                </div> -->

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 d-none d-sm-block">
                                <a class="filter-btn btn mr-2" id="filter-btn" type="button" data-toggle="collapse" data-target="#FilterCollapse" aria-expanded="false">
                                    <i class="fa fa-sliders-h"></i> Advance Filter
                                </a>
                            </div>

                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 d-block d-sm-none">
                                <a class="filter-btn btn mr-2" id="filter-btn" type="button" data-toggle="collapse" data-target="#FilterCollapse" aria-expanded="false">
                                    <i class="fa fa-sliders-h"></i>
                                </a>
                            </div>

                            
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 text-right d-none d-sm-block">
                                <button type="button" class="btn btn-primary ml-3 mb-3" data-toggle="modal" data-target="#add_modal"><i class="far fa-plus-square"></i> Add New</button>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 text-right d-block d-sm-none">
                                <button type="button" class="btn btn-primary ml-3 mb-3" data-toggle="modal" data-target="#add_modal"><i class="far fa-plus-square"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="collapse" id="FilterCollapse">
                    <div class="card card-body">
                        <div class="row justify-content-md-center">
                            <div class="col-xl-2 col-lg-3 col-md-4">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
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
                                </div>
                                <hr class="sidebar-divider d-md-none">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-8 col-sm-">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="row">
                                            <dt class="col-sm-12">Description</dt>
                                            <dd class="col-sm-12 mt-1">
                                                <select class="custom-select" name="description" id="filter_description">
                                                    <option value="0">All</option>
                                                    @foreach($descriptions as $desc)
                                                        <option value="{{$desc->tag_desc_id}}">{{ $desc->tag_desc_name }}</option>
                                                    @endforeach
                                                </select>
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                                <hr class="sidebar-divider d-md-none">
                            </div>
  
                        </div>

                        <div class="row justify-content-end">
                            <button class=" m-2 btn btn-secondary text-white" id="filter-reset-btn">
                                Reset
                            </button>
                            <button class="m-2 btn btn-primary text-white d-none" id="filter-set-btn">
                                Filter
                            </button>
                        </div>
                    </div>
                </div>

                <hr class="sidebar-divider mt-0 pt-0">
                
                <div class="table-responsive">
                    <table id="tag_info"  class="table table-hover cell-border dt-responsive" cellspacing="0" width="100%">
                        <thead class="text-white"> 
                            <tr>
                                <th>#</th>
                                <th>Citizen Name</th>
                                <th>Citizen Name</th>
                                <th>Citizen Name</th>
                                <th>Citizen Name</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Tag by</th>
                                <th>Tag by</th>
                                <th class="min-tablet">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Tag</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" id="tag-new" action="javascript:void(0)" class="row">
                    @csrf
                    <dt class="col-sm-12 edt_ct_lbl">Citizens Name </dt>
                    <dd class="col-sm-12">
                        <select class=" js-example-responsive form-control"  name="citizens_name" id="citizens_name"></select>
                        <div class="invalid-feedback">Please select citizen.</div>
                    </dd>
                    
                    <dt class="col-sm-12 edt_ct_lbl mt-2">Tag Description </dt>
                    <dd class="col-sm-12">
                        <select class="custom-select" name="description" id="description">
                            <option value="0" selected hidden disabled>Select Description</option>
                            @foreach($descriptions as $desc)
                                <option value="{{$desc->tag_desc_id}}">{{ $desc->tag_desc_name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Please select description.</div>
                    </dd>  
                </form>
                
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="add-new">Add New</button>
        </div>
        </div>
    </div>
</div>

<div class="toast" style="" id="new-toast" data-delay="3000">
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
        The citizen is already been tagged.
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
        You've successfully tagged a citizen.
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
        Successfully generated the tagging information. Please wait download will start shortly.
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
        No information to be generated.
    </div>
</div>

<div class="modal fade" id="modalSpinner" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Updating Tag List</h5>
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
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-none" id="row-gender">  
                        <div class="row">
                            <dt class="col-sm-6 col-12" id="fltr_l_Gender">Gender</dt>
                            <dd class="col-sm-6 col-12" id="fltr_gender"></dd>
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-none" id="row-description">  
                        <div class="row">
                            <dt class="col-sm-6 col-12" id="fltr_l_desc">Description</dt>
                            <dd class="col-sm-6 col-12" id="fltr_desc"></dd>
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




@endsection