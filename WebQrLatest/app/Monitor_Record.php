<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Monitor;

class Monitor_Record extends Model
{
    protected $table = "monitor_records";

    public $primaryKey = 'monitor_records_id';

    protected $fillable = [
        'monitor_records_created',
        'monitors_id',
        'symptoms_id'
    ];
    public $timestamps = false;

    public static function newMonitorRecord($request){
        $getSymptoms = explode(",",$request->symptoms);

        $getMonitor = Monitor::where('tags_id',$request->tag_id)
        ->where('monitor_types_id', $request->types_id)
        ->first();
        
        for ($i = 0; $i < sizeOf($getSymptoms); $i++) {
            $data = [
                [
                    'monitor_records_created' => date('Y-m-d H:i:s'),
                    'monitors_id' => $getMonitor->monitors_id,
                    'symptoms_id' => $getSymptoms[$i]
                ]
            ];
            Monitor_Record::insert($data);
        }

    }
}
