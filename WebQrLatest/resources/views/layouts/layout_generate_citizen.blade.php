<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libmanan Contact Tracing - Generate Information</title>


</head>
<body>

    <h1>Citizen Information</h1>
    <div style="clear: both;" id="generate">
        <p style="float: right; text-align:right; width: 30%;" id="date">Date & Time : {{ $date }}</p>
        <p style="float: left; width: 30%;" id="total">Total Inforamtion : {{ $data->count() }}</p>
    </div>

    <div class="table">
        <table class=" generate_info table table-striped" cellspacing="0" width="100%">
            <colgroup>
                <col style="width: 15%;">
                <col style="width: 5%;">
                <col style="width: 5%;">
                <col style="width: 10%;">
                <col style="width: 15%;">
                <col style="width: 25%;">
                <col style="width: 25%;">
            </colgroup>

            <tr>
                <th>Name</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Mobile</th>
                <th>Occupation</th>
                <th>Permanent Address</th>
                <th>Current Address</th>
            </tr>

            <tbody>
                @foreach ($data as $ct)
                    <tr>
                        <td>
                            {{ ucwords($ct->citizens_fname)  . ' ' . 
                                ucwords($ct->citizens_mname) . ' ' . 
                                ucwords($ct->citizens_lname)}}

                                @if($ct->citizens_suffix != null)
                                    {{' '. $ct->citizens_suffix}}
                                @endif


                        </td>
                        <td>
                            {{$ct->citizens_gender}}
                        </td>
                        <td>
                            {{ date("Y") - substr($ct->citizens_bday, 0,4) }}
                        </td>
                        <td>
                            {{$ct->citizens_mobile}}
                        </td>
                        <td>
                            {{$ct->citizens_profession}}
                        </td>
                        <td>
                            @if($ct->citizen_add_address != null)
                                {{$ct->citizen_add_address . ', '}}
                            @endif

                            @if($ct->zones_id != null)
                                @foreach($ct->getMainZone->get() as $zone)
                                    @if($zone->zones_id == $ct->zones_id)
                                        {{$zone->zones_name . ', '}}
                                    @endif
                                @endforeach
                            @endif

                            {{ ucwords(strtolower($ct->getMainBarangay->barangays_name)). ', '}}
                            {{ ucwords(strtolower($ct->getMainMunicipality->municipalities_name)). ', '}}
                            {{ ucwords(strtolower($ct->getMainProvince->province_name))}}
                        </td>

                        <td>
                            @if($ct->citizen_add_address_current != null)
                                {{$ct->citizen_add_address_current . ', '}}
                            @endif

                            @if($ct->zones_id_current != null)
                                @foreach($ct->CitizenToZone->get() as $zone)
                                    @if($zone->zones_id == $ct->zones_id_current)
                                        {{$zone->zones_name . ', '}}
                                    @endif
                                @endforeach
                            @endif

                            {{ ucwords(strtolower($ct->CitizenToBarangay->barangays_name)). ', '}}
                            {{ ucwords(strtolower($ct->CitizenToMunicipality->municipalities_name)). ', '}}
                            {{ ucwords(strtolower($ct->CitizenToProvince->province_name))}}

                      
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table >
    </div>
    
</body>
</html>
