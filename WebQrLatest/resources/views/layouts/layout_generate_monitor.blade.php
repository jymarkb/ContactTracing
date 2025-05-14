<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libmanan Contact Tracing - Generate Information</title>
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/AdminCSS/pdfCSS.css') }}"/> -->
    <!-- <link rel="stylesheet" href="asset('/css/AdminCSS/admin.css')"> -->

</head>
<body>
    <h1>Tagging Record</h1>
    <div style="clear: both;" id="generate">
        <p style="float: right; text-align:right; width: 30%;"id="date">Date & Time : {{ $date }}</p>
        <p style="float: left; width: 30%;" id="total">Total Inforamtion : {{ $data->count() }}</p>
    </div>
    
    <div class="table">
        <table id="generate_info"  class="table table-striped" cellspacing="0" width="100%">
            <!-- <colgroup>
                <col span="1" style="width: 20%;">
                <col span="1" style="width: 8%;">
                <col span="1" style="width: 5%;">
                <col span="1" style="width: 20%;">
                <col span="1" style="width: 5%;">
                <col span="1" style="width: 16%;">
                <col span="1" style="width: 8%;">
                <col span="1" style="width: 8%;">
                <col span="1" style="width: 10%;">
            </colgroup> -->

            <tr>
                <th style="width: 5%; text-align: center;">#</th>
                <th style="width: 20%;">Name</th>
                <th style="width: 6%;">Gender</th>
                <th style="width: 4%;">Age</th>
                <th style="width: 10%;">Description</th>
                <th style="width: 10%;">Status</th>
                <th style="width: 15%;">Facility</th>
                <th style="width: 10%;">Contact #</th>
                <th>Current Address</th>
            </tr>

            <tbody id="{{$count = 1}}">
                @foreach($data as $dt)
                <tr>
                    <td style="text-align: center;">{{$count++}}</td>
                    <td>
                        {{ ucwords(strtolower($dt->citizens_fname)) . ' ' . ucwords(strtolower($dt->citizens_mname)) . ' ' . ucwords(strtolower($dt->citizens_lname)) }}
                        
                        @if($dt->citizens_suffix != null)
                            {{ $dt->citizens_suffix}}
                        @endif
                    </td>
                    <td>{{ $dt->citizens_gender }}</td>
                    <td>{{ date('Y') - date('Y', strtotime($dt->citizens_bday)) }}</td>
                    <td>{{ $dt->tag_desc_name}}</td>
                    <td>{{ $dt->monitor_types_name}}</td>
                    <td>{{ $dt->facilities_desc}}</td>
                    <td>{{ $dt->citizens_mobile}}</td>
                    <td>
                        @if($dt->citizen_add_address_current != null)
                            {{ ucwords(strtolower($dt->citizen_add_address_current)) . ', ' }}
                        @endif

                        @if($dt->zones_id_current != null)
                            {{$dt->zones_name . ', '}}
                        @endif

                        {{
                            $dt->barangays_name . ', ' . $dt->municipalities_name . ', ' . $dt->province_name

                        }}

                    </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table >
    </div>
    
</body>
</html>
