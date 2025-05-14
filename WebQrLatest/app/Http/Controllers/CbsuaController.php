<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;
use App\Municipality;
use App\Barangay;
use App\Zone;
use App\Citizen;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class CbsuaController extends Controller
{
    public function getIndex(){
        return view('cbsua.home');
    }

    public function geteula(){
        return view('cbsua.registereula');
    }

    public function getform(){
        $province = Province::orderBy('province_name', 'ASC')->get();
        return view('cbsua.registerform', compact('province'));
    }

    public function getverify(){
        return view('cbsua.registerverify');
    }

    public function getAbout(){
        return view('cbsua.about');
    }

    public function getdownload(){
        if(session('citizen_mobile') == null){
            return redirect()->route('home');
        }
        $mobile = session('citizen_mobile');
        $getId = Citizen::where('citizens_mobile', $mobile)->first();
        $data = Citizen::postCitizenDetailGuest($getId->citizens_id);
        return view('cbsua.registercard', compact('data'));
    }

    public function postCode(Request $request){
        $codeSession = session('verification');
        $postCode = Citizen::postCode($codeSession, $request);
        return $postCode;
    }

    public function getMigrate(){
        Artisan::call('migrate:fresh');
        return "success";
    }

    public function getSeed(){
        Artisan::call('db:seed');
        return "success";
    }

    public function getLink(){
        Artisan::call('storage:link');
        return "success";
    }

    public function ajaxMuni(Request $request){
        $getMunicipality = Municipality::orderBy('municipalities_name')->get();;
        $data = array(
            'municipality' =>$getMunicipality,
        );
        return $data;
    }

    public function ajaxBrgy(Request $request){
        // $search = $request->search;
        return Barangay::where('municipalities_id', $request['muni_id'])->orderBy('barangays_name')->get();
        // $response = array();
        // foreach($data as $dt){
        //     $response [] = array(
        //         "id"=>$dt->barangays_id,
        //         "text"=>$dt->barangays_name
        //     );
        // }
        // return json_encode($response);
    }
    

    public function ajaxZone(Request $request){
        $getZone = Zone::orderBy('zones_name')->get();
        $data = array(
            'zone' =>$getZone,
        );
        return $data;
    }


    
}
