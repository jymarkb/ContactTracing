<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Barangay;
use App\Zone;
use App\Scan;

class Establishment extends Model
{
    protected $table = "establishments";
    public $primaryKey = 'establishments_id';
    protected $fillable = [
        'establishments_name',
        'establishments_permit',
        'zones_id',
        'barangays_id',
        'establishments_add_address',
    ];
    public $timestamps = false;

    public function EstablishmentToUser(){
        return $this->hasOne('App\User','establishments_id','establishments_id');
    }
    public function getBrgy(){
        return $this->hasOne('App\Barangay','barangays_id','barangays_id');
    }
    public function getZone(){
        return $this->hasOne('App\Zone','zones_id','zones_id');
    }
    public static function checkExist($request){
        $suffix = $request->es_suffix;
        if($suffix == '0'){
            $suffix = null;
        }
        $newEstablishment =  Establishment::where([
                ['establishments_name', '=' , $request['es_company']],
                ['establishments_permit', '=' , $request['es_permit']],
                ['zones_id', '=' , $request['es_zone']],
                ['barangays_id', '=' , $request['es_brgy']],
                ['establishments_add_address', '=' , $request['es_details']],
        ])->first();
            if($newEstablishment != null){
                $newUser = $newEstablishment->EstablishmentToUser()
                    ->where('users_fname', $request['es_fname'])
                    ->where('users_mname', $request['es_mname'])
                    ->where('users_lname', $request['es_lname'])
                    ->where('users_suffix', $suffix)
                    ->where('users_gender', $request['es_gender'])
                    ->where('users_bday', $request['es_year']. '-'. $request['es_month'] . '-'. $request['es_day'])
                    ->first();
                if ($newUser != null){
                    return true;
                }else{
                    return false;
                }
            }
        return false;
    }
    public static function EstablishmentAddNew($request){
        $suffix = $request->es_suffix;
        if($suffix == '0'){
            $suffix = null;
        }
        $newEstablishment = [
            'establishments_name' => $request['es_company'],
            'establishments_permit' => $request['es_permit'],
            'zones_id' => $request['es_zone'],
            'barangays_id' => $request['es_brgy'],
            'establishments_add_address' => $request['es_details'],
        ];
        Establishment::create($newEstablishment);
        $findES =  Establishment::where([
            ['establishments_name', '=' , $request['es_company']],
            ['establishments_permit', '=' , $request['es_permit']],
            ['zones_id', '=' , $request['es_zone']],
            ['barangays_id', '=' , $request['es_brgy']],
            ['establishments_add_address', '=' , $request['es_details']],
        ])->first();
        
        if(User::AddNewEstablishment($request, $findES, $suffix)){
            return true;
        }
        return false;
    }
    public static function getEstablishmentData($request){
        $data = Establishment::where('establishments_id',$request->select_id)
            ->with([
                'EstablishmentToUser',
                'getBrgy',
                'getZone'
            ])
            ->first();
        return $data;
    }
    public static function CheckExistUpdate($request){
        $suffix = $request->es_suffix;
        if($suffix == '0'){
            $suffix == null;
        }
        $es = Establishment::where([
            ['establishments_name', $request['es_company']],
            ['establishments_permit', $request['es_permit']],
            ['zones_id', $request['es_zone']],
            ['barangays_id', $request['es_brgy']],
            ['establishments_add_address', $request['es_bldg']],
        ])->first();
        if($es != null){
            if($es->establishments_id != $request->es_id){
                return 'true';
            }else{
                $esUser = User::
                where('users_fname', $request['es_fname'])
                ->where('users_mname', $request['es_mname'])
                ->where('users_lname', $request['es_lname'])
                ->where('users_suffix', $suffix)
                ->where('users_gender', $request['es_gender'])
                ->where('users_bday', $request['es_year']. '-'. $request['es_month'] . '-'. $request['es_day'])
                ->first();

                if($esUser != null){
                    if($esUser->users_id != $request->esUser_id){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
    }
    public static function EstablishmentUpdate($request){
        $esData = Establishment::where('establishments_id',$request['es_id'])
        ->update([
            'establishments_name' => $request['es_company'],
            'establishments_permit' => $request['es_permit'],
            'zones_id' => $request['es_zone'],
            'barangays_id' => $request['es_brgy'],
            'establishments_add_address' => $request['es_bldg'],
        ]);
        User::UpdateUserES($request);
        return 'true';
    }
    public static function getTableES(){
        date_default_timezone_set('Asia/Manila');
        $data = Establishment::with(['EstablishmentToUser','getBrgy','getZone'])
        ->get();
        $date = date('M j, Y g:i a');
        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_header' => 10,
            'margin_footer' => 8,
            'format' => 'A4-L',
        ]);
        $html = \View::make('layouts.layout_generate_establishment',compact('data', 'date'));
        $html = $html->render();
        $mpdf->SetFooter('Page {PAGENO}');
        $stylesheet = file_get_contents('css/AdminCSS/pdfCSS.css');
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Establishment-'.date('(Y-m-d) h:i:s A').'.pdf', 'D');
    }
    public static function sendCode($number,$code){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://ws-live.txtbox.com/v1/sms/push",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => array('message' => 'CBSUA Verification code - ' .$code,'number' => $number),
        CURLOPT_HTTPHEADER => array(
            "X-TXTBOX-Auth: bd6634972540039fbed3e55cccf351a6"
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        return "true";
    }

    public static function forgotSendCode($number,$code){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://ws-live.txtbox.com/v1/sms/push",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => array('message' => 'LIBCT Verification code for reseting PIN - ('.$code.')','number' => $number),
        CURLOPT_HTTPHEADER => array(
            "X-TXTBOX-Auth: bd6634972540039fbed3e55cccf351a6"
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        return "true";

    }

    public static function passwordSendCode($number,$code){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://ws-live.txtbox.com/v1/sms/push",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => array('message' => 'LIBCT Verification code for reseting password - ('.$code.')','number' => $number),
        CURLOPT_HTTPHEADER => array(
            "X-TXTBOX-Auth: bd6634972540039fbed3e55cccf351a6"
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        return "true";

    }


    public static function getBetween($string, $start, $end){
        if (strpos($string, $start)) { // required if $start not exist in $string
            $startCharCount = strpos($string, $start) + strlen($start);
            $firstSubStr = substr($string, $startCharCount, strlen($string));
            $endCharCount = strpos($firstSubStr, $end);
            if ($endCharCount == 0) {
                $endCharCount = strlen($firstSubStr);
            }
            return substr($firstSubStr, 0, $endCharCount);
        } else {
            return '';
        }
    }
    public static function downloadScannerNoFilter(){
        date_default_timezone_set('Asia/Manila');
        $date = date('M j, Y g:i a');
        $data = Scan::with('ScanToCitizen','ScanToEstablishment')->get();
        // return view('layouts.layout_generate_scanner', compact('date', 'data'));
        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_header' => 10,
            'margin_footer' => 8,
            'format' => 'A4-L',
        ]);
        $html = \View::make('layouts.layout_generate_scanner',compact('data', 'date'));
        $html = $html->render();
        $mpdf->SetFooter('Page {PAGENO}');
        $stylesheet = file_get_contents('css/AdminCSS/pdfCSS.css');
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Scanner-'.date('(Y-m-d) h:i:s A').'.pdf', 'D');
        
    }
    public static function downloadScannerFilter(){

        date_default_timezone_set('Asia/Manila');
        $date = date('M j, Y g:i a');

        $gender = session()->get('scan_gender');
        $scan_date = session()->get('scan_scan_date');
        $time_in = session()->get('scan_time_in');
        $time_out = session()->get('scan_time_out');
        $establishment = session()->get('scan_establishment');
        $update_start = session()->get('scan_update_start');
        $update_end = session()->get('scan_update_end');
        

        if($gender!= 'all'){
            $data = Scan::query();
            
            if($gender == "Male"){
                $data = $data -> whereHas('ScanToCitizen',function($query){
                    return $query->where('citizens_gender','Male');
                });
            }else{
                $data = $data -> whereHas('ScanToCitizen',function($query){
                    return $query->where('citizens_gender','Female');
                });
            }

            if($establishment != ''){
                $data = $data -> where('establishments_id',$establishment);
            }

            $sd = substr($scan_date, 6,4) . "-" . substr($scan_date, 0,2) . "-" . substr($scan_date, 3,2);
            if($time_in != '' && $time_out != ''){
                $data = $data -> where('scans_timein', '>=' , $sd . ' ' . $time_in);
                $data = $data -> where('scans_timeout', '<=', $sd . ' ' . $time_out);
            }else{
                if($scan_date != ''){
                    $data = $data -> whereDate('scans_timein', $sd);
                }
            }

            // if($update_start != '' && $update_end !=''){
            //     $start_dt = substr($update_start, 6,4) . "-" . substr($update_start, 0,2) . "-" . substr($update_start, 3,2) . " " . substr($update_start, 11,8);

            //     $end_dt = substr($update_end, 6,4) . "-" . substr($update_end, 0,2) . "-" . substr($update_end, 3,2) . " " . substr($update_end, 11,8);

            //     $data = $data -> whereBetween('scans_timeupdate', [$start_dt, $end_dt]);
            // }

            $data = $data->with(['ScanToCitizen', 'ScanToEstablishment'])->orderBy('scans_timein', 'desc')->get();

            // return response()->json([
            //     "data" => $data,
            // ]);

            $mpdf = new \Mpdf\Mpdf([
                'margin_left' => 10,
                'margin_right' => 10,
                'margin_top' => 10,
                'margin_bottom' => 10,
                'margin_header' => 10,
                'margin_footer' => 8,
                'format' => 'A4-L',
            ]);
            $html = \View::make('layouts.layout_generate_scanner',compact('data', 'date'));
            $html = $html->render();
            $mpdf->SetFooter('Page {PAGENO}');
            $stylesheet = file_get_contents('css/AdminCSS/pdfCSS.css');
            $mpdf->WriteHTML($stylesheet,1);
            $mpdf->WriteHTML($html);
            $mpdf->Output('Scanner-'.date('(Y-m-d) h:i:s A').'.pdf', 'D');

        }
        $data = Scan::query();
        if($establishment != ''){
            $data = $data -> where('establishments_id',$establishment);
        }
        $sd = substr($scan_date, 6,4) . "-" . substr($scan_date, 0,2) . "-" . substr($scan_date, 3,2);
        if($time_in != '' && $time_out != ''){
            $data = $data -> where('scans_timein', '>=' , $sd . ' ' . $time_in);
            $data = $data -> where('scans_timeout', '<=', $sd . ' ' . $time_out);
        }else{
            if($scan_date != ''){
                $data = $data -> whereDate('scans_timein', $sd);
            }
        }
        // if($update_start != '' && $update_end !=''){
        //     $start_dt = substr($update_start, 6,4) . "-" . substr($update_start, 0,2) . "-" . substr($update_start, 3,2) . " " . substr($update_start, 11,8);

        //     $end_dt = substr($update_end, 6,4) . "-" . substr($update_end, 0,2) . "-" . substr($update_end, 3,2) . " " . substr($update_end, 11,8);

        //     $data = $data -> whereBetween('scans_timeupdate', [$start_dt, $end_dt]);
        // }
        $data = $data->with(['ScanToCitizen', 'ScanToEstablishment'])->orderBy('scans_timein', 'desc')->get();

        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_header' => 10,
            'margin_footer' => 8,
            'format' => 'A4-L',
        ]);
        $html = \View::make('layouts.layout_generate_scanner',compact('data', 'date'));
        $html = $html->render();
        $mpdf->SetFooter('Page {PAGENO}');
        $stylesheet = file_get_contents('css/AdminCSS/pdfCSS.css');
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Scanner-'.date('(Y-m-d) h:i:s A').'.pdf', 'D');

        // return response()->json([
        //     "data" => $data, 
        // ]);

    }
    



}
