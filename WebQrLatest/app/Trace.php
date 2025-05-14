<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tag;
use App\Scan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Trace extends Model
{
    protected $table = 'traces';
    public $primaryKey = 'traces_id';
    protected $fillable = [
        'traces_date_time', 
        'scans_id',
        'tags_id',
    ];
    public $timestamps = false;

    public function tags(){
        return this()->belongsTo('App\Tag', 'tags_id', 'tags_id');
    }

    public static function getSuspects(){
        $change=0;
        $suspectsData = Tag::whereIn('tag_desc_id',[6,8])->doesntHave('manyTrace')->get();

        for($i = 0; $i < count($suspectsData); $i++){
            $getScanData =  Trace::getScan($suspectsData[$i]->citizens_id);

            if($getScanData != null){
                
                for($j = 0; $j < count($getScanData); $j++){

                    Trace::addNewTrace($getScanData[$j]->scans_id, $suspectsData[$i]->tags_id); //insert current citizen-positive-scan-history
                    $contactScan = Trace::getContactScan($getScanData[$j]->scans_timein, $getScanData[$j]->scans_timeout, $getScanData[$j]->establishments_id); //get current-citizen-contact-scan-history

                    for($k = 0; $k < count($contactScan); $k++){
                        $change++;
                        Trace::newContactTag($contactScan[$k]->citizens_id); //insert level 1 tag
                        Trace::newContactTrace($contactScan[$k]->scans_id,$suspectsData[$i]->tags_id); //insert level 1 trace
                        /*echo $k." \n " .$contactScan[$k]->citizens_id ."insert tag \n ";
                        echo $contactScan[$k]->scans_id ." " . $suspectsData[$i]->tags_id ." insert trace \n";
                        echo $contactScan[$k]. "\n";*/
                    }    
                }  
            }
            Trace::checkOutsider($suspectsData[$i]->citizens_id,$suspectsData[$i]->tags_id);
        }

        if($change > 0){
            Trace::getSuspects();
        }else{
            $data = DB::table('citizens')
            ->join('tags', 'citizens.citizens_id', '=' , 'tags.citizens_id')
            ->join('tag_description', 'tag_description.tag_desc_id', '=', 'tags.tag_desc_id')
            ->join('users', 'tags.users_id', '=' , 'users.users_id')
            ->groupBy('citizens.citizens_id')
            ->get();

           //foreach($data as $dt){Tag::sendNewSms($dt->citizens_id, $dt->tag_desc_id);}
        }
    }

    public static function getScan($citizens_id){
        $scanData = Scan::where('citizens_id',$citizens_id)->get();
        return $scanData;
    }
    public static function addNewTrace($scans_id, $tags_id){
        $new = [
            [
                "traces_date_time" => date('Y-m-d H:i:s'),
                "scans_id" => $scans_id,
                "tags_id" => $tags_id
            ]
        ];
        Trace::insert($new);
    }
    public static function getContactScan($timein, $timeout, $es_id){
        $scanData = Scan::where('establishments_id',$es_id)
        ->where('scans_timein', '>', $timein)
        ->where('scans_timein', '<', $timeout)
        ->get();
        return $scanData;
    }
    public static function newContactTag($citizens_id){
        $data = [
            [
                "tags_date_time" => date('Y-m-d H:i:s'),
                "tag_desc_id" => "8",
                "citizens_id"=>$citizens_id,
                "users_id"=> Auth::user()->users_id

            ]
        ];
        Tag::insert($data);
        return true;
    }
    public static function newContactTrace($scans_id, $tags_id){
        $data = [
            [
                "traces_date_time" => date('Y-m-d H:i:s'),
                "scans_id" => $scans_id,
                "tags_id" => $tags_id
            ]
        ];
        Trace::insert($data);
        return true;
    }
    public static function checkOutsider($citizens_id, $tag_id){
        $checkTag = Tag::where('citizens_id',$citizens_id)
        ->whereIn('tag_desc_id', [3,4])
        ->first();

        if($checkTag != null){
            $traceNoScan = Trace::addNewTraceNoScan($tag_id);
            return true;
        }else{
            return false;
        }
        
    }
    public static function addNewTraceNoScan($tags_id){
        $new = [
            [
                "traces_date_time" => date('Y-m-d H:i:s'),
                "tags_id" => $tags_id
            ]
        ];
        Trace::insert($new);
    }

    




   




}
