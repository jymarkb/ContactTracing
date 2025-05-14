<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Citizen;
use App\User;
use App\Tag_Description;
use App\Monitor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Tag extends Model
{
    protected $table = 'tags';

    public $primaryKey = 'tags_id';

    protected $fillable = [
        'tags_date_time', 
        'citizens_id',
        'tag_desc_id',
        'users_id',
    ];
    public $timestamps = false;

    public function citizens(){
        return $this->belongsTo(Citizen::class, 'citizens_id', 'citizens_id');
    }
    public function users(){
        return $this->belongsTo(User::class, 'users_id', 'users_id');
    }
    public function descriptions(){
        return $this->hasOne(Tag_Description::class, 'tag_desc_id', 'tag_desc_id');
    }
    public function monitor_tag(){
        return $this->hasOne(Monitor::class, 'tags_id', 'tags_id');
    }
    public function manyTrace(){
        return $this->hasMany(Trace::class, 'tags_id', 'tags_id');
    }

    public static function checkTag($request){
        $data = Tag::where('citizens_id',$request->citizens_name)
        ->latest('tags_date_time')
        ->first();

        if($data != null){
            if($data->tag_desc_id != $request->description){
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }
    public static function newTag($request){
        date_default_timezone_set('Asia/Manila');
        $data = [
            'tags_date_time' => date('Y-m-d H:i:s'),
            'citizens_id' =>$request->citizens_name,
            'tag_desc_id' =>$request->description,
            'users_id'=> Auth::user()->users_id,
        ];

        Tag::insert($data); 
    }
    public static function sendMessage($request){
        $getCitizen = Citizen::where('citizens_id',$request->citizens_name)->first();
        $tag_desc = Tag_Description::where('tag_desc_id',$request->description)->first();
        $citizen_message = 'LIBCT [Alert] As of ' . date('F j, Y, g:i a');

        $number = $getCitizen->citizens_mobile;
        $tag_id = $request->description;
        switch($tag_id){
            case 2:
                $citizen_message .= " you have been (blocked) in the system.  Please contact nearest local government unit.";
                break;
            case 1:
                $citizen_message .= " you have been (unblocked) in the system. Thank you for your cooperatation.";
                break;
            case 3: case 4:
                $citizen_message .= " you have been tagged as (" . $tag_desc->tag_desc_name .   ") in the system. Please complete your quarantine schedule and wait for release confirmation. Thank you for your cooperatation.";
                break;
            case 5:
                $citizen_message .= " you have been tagged as (Release) thank you for cooperation. You can now go outside or enter establishment you like.";
                break;
            case 6:
                $citizen_message .=" you have been tagged as (Positive) of COVID-19. The local goverment is on the move to get you in the treating facility. Please be guided and don't interact to other persons.";
                break;
            case 7:
                $citizen_message .=" you have been tagged as (Negative) of COVID-19. Please be guide and wait for the release confirmation.";
                break;
            case 8:
                $citizen_message .=" you have been tagged as (Contact Person) of confirmed case of COVID-19. The local goverment is on the move to get you in the treating facility. Please be guided and don't interact to other persons.";
                break;
        }

        if($getCitizen!= null){
            
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
            CURLOPT_POSTFIELDS => array('message' => $citizen_message ,'number' => $number),
            CURLOPT_HTTPHEADER => array(
                "X-TXTBOX-Auth: bd6634972540039fbed3e55cccf351a6"
            ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            return true;
        }



        

    }
    public static function sendNewSms($citizens_id, $reason){
        $getCitizen = Citizen::where('citizens_id',$citizens_id)->first();
        $tag_desc = Tag_Description::where('tag_desc_id',$reason)->first();
        $citizen_message = 'LIBCT [Alert] As of ' . date('F j, Y, g:i a');

        $number = $getCitizen->citizens_mobile;
        $tag_id = $reason;
        switch($tag_id){
            case 2:
                $citizen_message .= " you have been (blocked) in the system.  Please contact nearest local government unit.";
                break;
            case 1:
                $citizen_message .= " you have been (unblocked) in the system. Thank you for your cooperatation.";
                break;
            case 3: case 4:
                $citizen_message .= " you have been tagged as (" . $tag_desc->tag_desc_name .   ") in the system. Please complete your quarantine schedule and wait for release confirmation. Thank you for your cooperatation.";
                break;
            case 5:
                $citizen_message .= " you have been tagged as (Release) thank you for cooperation. You can now go outside or enter establishment you like.";
                break;
            case 6:
                $citizen_message .=" you have been tagged as (Positive) of COVID-19. The local goverment is on the move to get you in the treating facility. Please be guided and don't interact to other persons.";
                break;
            case 7:
                $citizen_message .=" you have been tagged as (Negative) of COVID-19. Please be guide and wait for the release confirmation.";
                break;
            case 8:
                $citizen_message .=" you have been tagged as (Contact Person) of confirmed case of COVID-19. The local goverment is on the move to get you in the treating facility. Please be guided and don't interact to other persons.";
                break;
        }

        if($getCitizen!= null){
            
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
            CURLOPT_POSTFIELDS => array('message' => $citizen_message ,'number' => $number),
            CURLOPT_HTTPHEADER => array(
                "X-TXTBOX-Auth: bd6634972540039fbed3e55cccf351a6"
            ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            return true;
        }
    }

    public static function getTableTagging($request){
        $gender = "All"; $descriptions="";

        if($request['gender'] != ''){
            $gender = $request['gender'];
        }
        if($request['description'] != ''){
            $descriptions = $request['description'];
        }

        session()->put('tag_gender', $gender);
        session()->put('tag_descriptions', $descriptions);

        if($gender != 'All'){
            $data = DB::table('citizens')
            ->join('tags', 'citizens.citizens_id', '=' , 'tags.citizens_id')
            ->join('tag_description', 'tag_description.tag_desc_id', '=', 'tags.tag_desc_id')
            ->join('users', 'tags.users_id', '=' , 'users.users_id')
            ->where('citizens.citizens_gender', '=' , $gender);

            if($descriptions != ''){
                $data = $data -> where('tags.tag_desc_id', '=' , $descriptions);
            }
            
            $data = $data 
            -> groupBy('citizens.citizens_id', 'tag_description.tag_desc_id')
            -> get();

            return response()->json([
                "data" => $data,
            ]);
        }

        $data = DB::table('citizens')
        ->join('tags', 'citizens.citizens_id', '=' , 'tags.citizens_id')
        ->join('tag_description', 'tag_description.tag_desc_id', '=', 'tags.tag_desc_id')
        ->join('users', 'tags.users_id', '=' , 'users.users_id');

        if($descriptions != ''){
            $data = $data -> where('tags.tag_desc_id', '=' , $descriptions);
        }

        $data = $data 
        -> groupBy('citizens.citizens_id', 'tag_description.tag_desc_id')
        -> get();

        return response()->json([
            "data" => $data,
        ]);
    }


}
