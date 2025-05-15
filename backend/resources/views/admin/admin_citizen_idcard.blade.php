@extends('layouts.layout_admin')

@section('title', 'Citizen / Identification Card')

@section('css-import')
<link href="{{ asset('css/AdminCSS/admin.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('css/dtCSS/datatables.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/dtCSS/responsive.dataTables.min.css') }}"/>
<link href="{{ asset('css/styleRegistrationId.css') }}" rel="stylesheet">

<!-- <style>
    div.dataTables_wrapper  div.dataTables_filter {
    width: 100%;
    float: none;
    text-align: center;
    }
</style> -->


@endsection

@section('js-import')
<script type="text/javascript" src="{{ asset('js/dtJS/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dtJS/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dtJS/dataTables.select.min.js') }}"></script>
<script src="{{ asset('js/Admin/admin.js') }}"></script>
<script src="{{ asset('js/Admin/admin-id-card.js') }}"></script>


@endsection


@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Citizen / <span class="add-title"> Identification Card</span></h1>
</div>

<div class="row">
    <div class="col-xl-7 col-lg-6 col-md-12 col-sm-12 col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h3 class="m-0 font-weight-bold text-primary">Search Citizen</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="citizen_id_record"  class="table table-hover text-dark" cellspacing="0" width="100%">
                        <thead class="text-white">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                            </tr>
                        </thead>

                        <tbody id="{{$counter=1}}">
                            @foreach($citi as $ct)
                                <tr id="{{ $ct->citizens_id  }}">
                                    <td class="text-center">{{ $counter++ }}</td>
                                    <td>
                                    @if($ct->citizens_suffix != null)
                                        {{ ucwords($ct->citizens_fname)  . ' ' . ucwords($ct->citizens_mname) . ' ' . ucwords($ct->citizens_lname) . ' '  . $ct->citizens_suffix}}
                                    @else
                                        {{ ucwords($ct->citizens_fname)  . ' ' . ucwords($ct->citizens_mname) . ' ' . ucwords($ct->citizens_lname)}}
                                    @endif
                                    
                                    
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12 d-none" id="form-id-col1">
        <div class="row idrow">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 form-id-columns" >

            <div class=" card card-id text-black" id="person">
                    <img src="{{asset('images/system/id-format.png')}}" class=" mt-2 mb-5 card-img mx-auto id-format" alt="Profile">

                    <div class="card-img-overlay">
                        <div class="row">
                            <div class="col-6">
                                <img id="citizen-img" class="id-profile" width="192px" height="192px" alt="">

                            </div>

                            <div class="col-6">
                                <dl class="row id-details-row">
                                    <dt class="col-sm-12">Full Name</dt>
                                    <dd class="col-sm-12" id="citi_name"> </dd>
                                    <dt class="col-sm-12">Address</dt>
                                    <dd class="col-sm-12" id="citi_address"> </dd>
                                    <dt class="col-sm-12">Gender</dt>
                                    <dd class="col-sm-12" id="citi_gender"> </dd>
                                </dl>
                            </div>
                        </div>

                
                        <div class="row qr-code-row justify-content-center mt-2">
                            <img class="w-100" id="qr-src" alt="">
                        </div>

    
                    </div>

                    
                </div>


                <button class="btn btn-success btn-block btn-lg" id="download">DOWNLOAD IDENTIFICATION CARD</button>

            </div>
        </div>
    </div>

</div>




@endsection