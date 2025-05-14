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
    <h1>Scanner Record</h1>
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
                <th style="width: 20%;">Name</th>
                <th>Gender</th>
                <th>Age</th>
                <th style="width: 20%;">Establishment</th>
                <th>Temperature</th>
                <th>Scan Date</th>
                <th>Time Out</th>
                <th>Time In</th>
                <th>Contact #</th>
            </tr>

            <tbody>
                @foreach($data as $dt)
                <tr>
                    <td style="width: 20%;">
                        @if($dt->ScanToCitizen->citizens_suffix != null)
                            {{ ucwords(strtolower($dt->ScanToCitizen->citizens_fname)) . ', ' . ucwords(strtolower($dt->ScanToCitizen->citizens_mname)) . ' ' . ucwords(strtolower($dt->ScanToCitizen->citizens_lname)) . ' ' . $dt->ScanToCitizen->citizens_suffix }}
                        @else
                            {{ ucwords(strtolower($dt->ScanToCitizen->citizens_fname)) . ', ' . ucwords(strtolower($dt->ScanToCitizen->citizens_mname)) . ' ' . ucwords(strtolower($dt->ScanToCitizen->citizens_lname)) }}
                        @endif
                    </td>

                    <td>{{ $dt->ScanToCitizen->citizens_gender }}</td>
                    <td>{{ date('Y') - date('Y', strtotime($dt->ScanToCitizen->citizens_bday))}}</td>
                    <td style="width: 20%;">{{ $dt->ScanToEstablishment->establishments_name }}</td>
                    <td>{{ $dt->scans_temperature }}  &#176;C </td>
                    <td>{{ date('F d, Y', strtotime($dt->scans_timein)) }}</td>
                    <td>{{ date('h:s A', strtotime($dt->scans_timein)) }}</td>
                    <td>{{ date('h:s A', strtotime($dt->scans_timeout)) }}</td>
                    <td>+63{{ substr($dt->ScanToCitizen->citizens_mobile, 1) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table >
    </div>
    
</body>
</html>
