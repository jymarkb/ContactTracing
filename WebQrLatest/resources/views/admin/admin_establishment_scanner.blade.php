@extends('layouts.layout_admin')

@section('title', 'Establishment / Scanner')

@section('css-import')
<link href="{{ asset('css/AdminCSS/admin.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('css/dtCSS/datatables.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/dtCSS/responsive.dataTables.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/dtCSS/jquery.datetimepicker.css') }}"/>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css"/> -->
@endsection

@section('js-import-add')
<script type="text/javascript" src="{{ asset('js/dtJS/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dtJS/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dtJS/dataTables.select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dtJS/jquery.datetimepicker.full.min.js') }}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script> -->


<script src="{{ asset('js/Admin/admin.js') }}"></script>
<script src="{{ asset('js/Admin/admin-es-scanner-dt.js') }}"></script>
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Establishment / <span class="add-title">Scanner</span></h1>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-xl-9 col-lg-8 col-md-7 col-sm-12 col-12 mb-3 mb-md-0">
                        <h3 class="m-0 font-weight-bold text-primary">Scanner Table</h3>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-5 col-sm-12 col-12 d-flex  justify-content-md-end">
                        <button class="btn btn-sm btn-primary shadow-sm" id="generateInfo">
                            <i class="fas fa-download fa-sm text-white-50"></i> Generate Information
                        </button>

                        <a href="/download/nofilter/scanner" class="btn btn-sm d-none btn-primary shadow-sm" id="downloadNoFilter" >
                            <i class="fas fa-download fa-sm text-white-50"></i> Generate Information
                        </a>
                        
                        <a href="/download/filter/scanner" class="btn btn-sm d-none btn-primary shadow-sm" id="downloadFilter">
                            <i class="fas fa-download fa-sm text-white-50"></i> Generate Information
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <a class="filter-btn mr-2" id="filter-btn" type="button" data-toggle="collapse" data-target="#FilterCollapse" aria-expanded="false">
                    <i class="fa fa-sliders-h"></i> Advance Filter
                </a>

                <div class="collapse" id="FilterCollapse">
                    <div class="card card-body">
                        <div class="row justify-content-md-center">
                            <div class="col-xl-3 col-lg-4 col-md-12">
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
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="row mt-4">
                                            <dt class="col-sm-12">Establishment</dt>
                                            <dd class="col-sm-12 mt-1">
                                                <select class="custom-select" id="es_name"> 
                                                    <option selected value="0">All</option>
                                                    @foreach($es as $e)
                                                        <option value="{{$e->establishments_id}}">{{ ucwords(strtolower($e->establishments_name)) }}</option>
                                                    @endforeach
                                                </select>
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-12">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="row">
                                            <dt class="col-sm-12">Scan Date</dt>
                                            <dd class="col-sm-12 mt-1">
                                                <input type="text" class="form-control" id="scan_date">
                                            </dd>
                                        </div>
                                        <div class="row">
                                            <dt class="col-sm-12">Time In</dt>
                                            <dd class="col-sm-12 mt-1">
                                                <input type="text" class="form-control" id="time_in">
                                            </dd>
                                        </div>
                                        <div class="row">
                                            <dt class="col-sm-12">Time Out</dt>
                                            <dd class="col-sm-12 mt-1">
                                                <input type="text" class="form-control" id="time_out">
                                            </dd>
                                        </div>
                                    </div>
                                </div>

                                <hr class="sidebar-divider mt-3 d-md-none">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 d-none">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        
                                        
                                        <div class="row">
                                            <dt class="col-sm-12">Server Update</dt>
                                            <dd class="col-sm-12 mt-1">
                                                <div class="row">
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group">
                                                            <label for="age_from">Start :</label>
                                                            <input type="text" class="form-control" id="server_datemin">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group">
                                                            <label for="age_from">End :</label>
                                                            <input type="text" class="form-control" id="server_datemax">
                                                        </div>
                                                    </div>
                                                </div>
                                             
                                                
                                            </dd>
                                        </div>
                                    </div>
                                </div>
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

                <hr class="sidebar-divider">


                <div class="table-responsive">
                    <table id="establishment_info"  class="table table-hover cell-border dt-responsive" cellspacing="0" style="width:100%">
                        
                        <thead class="text-white"> 
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Name</th>
                                <th>Name</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Establishment</th>
                                <th class="text-nowrap">Scan Date</th>
                                <th class="text-nowrap">Time In</th>
                                <th class="text-nowrap">Time Out</th>
                                <th>Tempterature</th>
                                <th class="text-nowrap">Server Update</th>
                            </tr>
                        </thead>
                    </table >
                </div>
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

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" id="row-es">  
                        <div class="row">
                            <dt class="col-sm-6 col-12" id="fltr_l_ES">Establishment</dt>
                            <dd class="col-sm-6 col-12" id="fltr_ES"></dd>
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-none" id="row-scandt">  
                        <div class="row">
                            <dt class="col-sm-6 col-12" id="fltr_l_ScanDate">Scan Date</dt>
                            <dd class="col-sm-6 col-12" id="fltr_ScanDate"></dd>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="row">
                                            <dt class="col-sm-6 col-12" id="fltr_l_in">Time In</dt>
                                            <dd class="col-sm-6 col-12" id="fltr_in"></dd>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="row">
                                            <dt class="col-sm-6 col-12" id="fltr_l_in">Time Out</dt>
                                            <dd class="col-sm-6 col-12" id="fltr_out"></dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-none" id="row-serverup"> 
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="row">
                                    <dt class="col-sm-6 col-12" id="fltr_l_in">Server Update</dt>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="row">
                                    <dt class="col-sm-6 col-12" id="fltr_l_in">Start</dt>
                                    <dd class="col-sm-6 col-12" id="fltr_start"></dd>
                                </div>
                                <div class="row">
                                    <dt class="col-sm-6 col-12" id="fltr_l_in">End</dt>
                                    <dd class="col-sm-6 col-12" id="fltr_end"></dd>
                                </div>
                            </div>

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
<div class="toast" id="generate-toast" data-delay="3000">
    <div class="toast-header bg-info text-white">
        <strong class="mr-auto">Information</strong>
        <small>just now</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        Successfully generated the scanner information. Please wait download will start shortly.
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

@endsection