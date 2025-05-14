<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Scan extends Model
{
    protected $table = "scans";
    public $primaryKey = 'scans_id';
    protected $fillable = [
        'scans_temperature',
        'scans_timein',
        'scans_timeout',
        'scans_status',
        'scans_timeupdate',
        'establishments_id',
        'citizens_id',
    ];
    public $timestamps = false;

    public function ScanToCitizen(){
        return $this->belongsTo('App\Citizen','citizens_id','citizens_id');
    }
    public function ScanToEstablishment(){
        return $this->belongsTo('App\Establishment','establishments_id','establishments_id');
    }
    public static function getESscanner($request){
        date_default_timezone_set('Asia/Manila');
        $gender = 'all';$scan_date=''; $time_in=''; $time_out='';
        $establishment='';$update_start =''; $update_end='';

        if($request->gender != ''){
            $gender =$request->gender;
        }
        if($request->scan_date != ''){
            $scan_date = $request->scan_date;
        }
        if($request->time_in != ''){
            $time_in = $request->time_in;
            $time_out = $request->time_out;
        }
        if($request->establishment != ''){
            $establishment = $request->establishment;
        }
        if($request->update_start != ''){
            $update_start = $request->update_start;
            $update_end = $request->update_end;
        }

        session()->put('scan_gender', $gender);
        session()->put('scan_scan_date', $scan_date);
        session()->put('scan_time_in', $time_in);
        session()->put('scan_time_out', $time_out);
        session()->put('scan_establishment', $establishment);
        session()->put('scan_update_start', $update_start);
        session()->put('scan_update_end', $update_end);

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

            return response()->json([
                "data" => $data,
            ]);
        }else{

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
            return response()->json([
                "data" => $data, 
                "scan_date" =>$sd . ' 00:00:00',
                "in" => $time_in,
                "out" => $time_out,
                "us" => $update_start,
                "ue" => $update_end
            ]);

        }
        
    }

    
}
