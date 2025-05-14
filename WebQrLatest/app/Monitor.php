<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tag;
use App\Monitor_Type;
use App\Facility;

class Monitor extends Model
{
    protected $table = "monitors";

    public $primaryKey = 'monitors_id ';

    protected $fillable = [
        'symptoms_id',
        'tags_id',
    ];
    public $timestamps = false;

    public function tags(){
        return $this->hasOne(Tag::class, 'tags_id', 'tags_id');
    }
    public function types(){
        return $this->belongsTo(Monitor_Type::class, 'monitor_types_id', 'monitor_types_id');
    }
    public function facility(){
        return $this->hasOne(Facility::class, 'facilities_id', 'facilities_id');
    }

    public static function checkMonitor($request){
        $data = Monitor::where('tags_id',$request->tag_id)->first();
        if($data != null){
            return true;
        }else{
            return false;
        }
    }
    public static function postNewMonitor($request){
        date_default_timezone_set('Asia/Manila');
        $data = [
            "monitors_created" => date('Y-m-d H:i:s'),
            "monitors_updated" => null,
            "tags_id" => $request->tag_id,
            "monitor_types_id" =>$request->types_id,
            "facilities_id" => $request->facility_id
        ];
        Monitor::insert($data);
    }


}
