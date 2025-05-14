<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Establishment;
use App\Scan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Tag;

class EstablishmentController extends Controller
{
    public function checkMobile(Request $request){
        $mobile = $request->only('mobile');

        $user = User::where('users_mobile',$request['mobile'])->where('types_id',4)->first();

        if($user != null){
            if($user->users_username != null && $user->users_password != null){
                echo "exist";
            }else{
                echo "true";
            }
        }else{
            echo "false";
        }
    }

    public function sendCode(Request $request){
        Establishment::sendCode($request['mobile'], $request['code']);
        echo "true";
    }
    public function setAccount(Request $request){
        $username = $request['username'];
        $password = $request['password'];
        $mobile = $request['mobile'];

        $user = User::where('users_username',$username)->first();

        if($user != null){
            echo 'exist';
        }else{
            User::where('users_mobile',$mobile)
                ->update([
                    'users_username'=>$username,
                    'users_password'=>Hash::make($password),
                ]);
            echo 'success';
        }

        // echo $mobile .' ' . $username . ' ' . $password;

    }
    public function login(Request $request){
        $username = $request['username'];
        $password = $request['password'];

        $user = User::where('users_username',$username)
            ->with('getCompany')
            ->first();

        if($user != null){
            $userpassword = $user->users_password;
            if (Hash::check($request['password'], $userpassword)) {
                return response()->json([
                    "success"=>true,
                    "es_id"=>$user->establishments_id,
                    "es_name"=>$user->getCompany->establishments_name,
                    "es_pin"=>$user->getCompany->establishments_pin,
                    "users_id"=>$user->users_id
                ]);
            }else{
                return response()->json([
                    "success"=>false
                ]);
            }
        }else{
            return response()->json([
                "success"=>false
            ]);
        }
    }
    public function updatePin(Request $request){
        Establishment::where('establishments_id',$request->es_id)->update(['establishments_pin'=>$request->es_pin]);
        return "true";
    }


    public function forgotCheckAccount(Request $request){
        $user = User::where('users_username',$request->username)
            ->where('users_mobile',$request->number)
            ->where('types_id',4)
            ->with('getCompany')
            ->first();

        if($user != null){
            if(Hash::check($request->password,$user->users_password)){
                return response()->json([
                    "success"=>true,
                    "es_id"=>$user->establishments_id,
                    "users_id"=>$user->users_id
                ]);
            }else{
                return response()->json([
                    "success"=>false
                ]);
            }
        }else{
            return response()->json([
                "success"=>false
            ]);
        }
        return $user;
        
    }

    public function forgotSendCode(Request $request){
        Establishment::forgotSendCode($request['mobile'], $request['code']);
        echo "true";
    }

    public function updateNewPIN(Request $request){
        Establishment::where('establishments_id',$request->es_id)->update(['establishments_pin'=>$request->es_pin]);
        return "true";
    }

    public function passwordCheckAccount(Request $request){
        $user = User::where('users_username',$request->username)
            ->where('types_id',4)
            ->first();

        if($user != null){
            return response()->json([
                "success"=>true,
                "mobile"=>$user->users_mobile
            ]);

        }else{
            return response()->json([
                "success"=>false
            ]);
        }
    }

    public function passwordSendCode(Request $request){
        Establishment::passwordSendCode($request['mobile'], $request['code']);
        echo "true";
    }

    public function updateNewPassword(Request $request){
        User::where('users_mobile',$request->mobile)
        ->where('types_id','4')
        ->update(['users_password'=>Hash::make($request->password)]);
        return "true";
    }

    public function updateScanQRcode(Request $request){
        date_default_timezone_set('Asia/Manila');

        $formatString  = substr($request->citizen_id, 6);

        $getID = Establishment::getBetween($formatString, "jmb", "520");
        
        $oldScan = Scan::where('scans_temperature',$request->temperature)
            ->where('scans_timein', $request->time_in)
            ->where('scans_timeout', $request->time_out)
            ->where('scans_status','server')
            ->whereDate('scans_timeupdate',Carbon::today())
            ->where('establishments_id', $request->es_id)
            ->where('citizens_id',$getID)
            ->first();

        if($oldScan !=null){
            return "true";
        }else{
        $newScanQRcode = 
            [
                'scans_temperature' => $request->temperature,
                'scans_timein' => $request->time_in,
                'scans_timeout' => $request->time_out,
                'scans_status' => 'server',
                'scans_timeupdate' => date('Y-m-d H:i:s'),
                'establishments_id' => $request->es_id,
                'citizens_id' => $getID,

            ];
        Scan::create($newScanQRcode);
        return "true";
        }
    }

    public function citizenTags(Request $request){
        $data = Tag::get();

        if($data != null){
            return response()->json([
                "success"=>true,
                "tags"=>$data
            ]);
        }

        return response()->json([
            "success"=>false
        ]);
        
    }
}
