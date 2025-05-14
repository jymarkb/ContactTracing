<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libmanan Contact Tracing - Generate Information</title>
    <!-- <style>
        @font-face { 
        font-family: Nunito-Regular; 
        src: url('/fonts/Nunito-Regular.ttf');
        }
   
        #generate_info td, #generate_info th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #generate_info th {
            text-align: left;
            background-color:#343A40;
            font-family: 'Nunito-Regular';
            color: white;
            font-size:12px;
        }

        #generate_info tbody tr{
            font-family: 'Nunito-Regular';
            font-size:12px;
        }


        #generate_info tr:nth-child(even){
            background-color: #f2f2f2;
        }

        *{
            font-family: 'Nunito-Regular';
        }

        
        h1 {
            text-align: center;
            display; block;
            margin:0.5rem;
        }

        p{
            font-size:12px;
            margin: 0px;
            padding: 0px;
        }
        #date {
            float:right
        }
        
        #generate{
            style="clear: both;
            
        }
    
    </style> -->

</head>
<body>
    <h1>Establishment Information</h1>
    <div style="clear: both;" id="generate">
        <p style="float: right; text-align:right; width: 30%;"id="date">Date & Time : {{ $date }}</p>
        <p style="float: left; width: 30%;" id="total">Total Inforamtion : {{ $data->count() }}</p>
    </div>
    
    <div class="table">
        <table id="generate_info"  class="table table-striped" cellspacing="0" width="100%">
            <colgroup>
                <col span="1" style="width: 20%;">
                <col span="1" style="width: 20%;">
                <col span="1" style="width: 15%;">
                <col span="1" style="width: 55%;">
            </colgroup>

            <tr>
                <th>Name</th>
                <th>Owner</th>
                <th>Permit</th>
                <th>Address</th>
            </tr>
            
            <tbody>
                @foreach($data as $dt)
                <tr>
                    <td>{{ ucwords(strtolower($dt->establishments_name)) }}</td>
                    <td>{{ ucwords(strtolower($dt->EstablishmentToUser->users_fname)) . ' ' . ucwords(strtolower($dt->EstablishmentToUser->users_mname)) . ' ' . ucwords(strtolower($dt->EstablishmentToUser->users_lname)) }}

                       @if($dt->EstablishmentToUser->users_suffix != null) 
                            {{ ' ' . $dt->EstablishmentToUser->users_suffix }}
                       @endif
                    </td>
                    <td>{{ $dt->establishments_permit }}</td>
                    <td>
                        @if($dt->establishments_add_address != null)
                            {{ $dt->establishments_add_address . ', ' }}
                        @endif

                        {{ $dt->getZone->zones_name .', ' . $dt->getBrgy->barangays_name . ', Libmanan, Camarines Sur' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table >
    </div>
    
</body>
</html>
