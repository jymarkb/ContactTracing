<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;
use App\Municipality;
use App\Barangay;
use App\Zone;
use App\Citizen;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;



class CitizenController extends Controller
{

    public function getIndex(){
        session()->flush();
        return view('welcome');
        
    }

    //--- citizen registration form
    public function getEULA(){
        return view('citizen.individualEULA');
    }
    public function getIndividual(){
        $province = Province::orderBy('province_name', 'ASC')->get();
        $data = array(
            'province' => $province,
            'curProvince' =>$province
        );
        return view('citizen.individualForm')->with($data);
    }
    public function getVerification(){
        if(session('verification') == null){
            return redirect()->route('home');
        }
        return view('citizen.individualFormVerification');
    }
    public function getSummary(){
        if(session('citizen_mobile') == null){
            return redirect()->route('home');
        }
        $mobile = session('citizen_mobile');
        $getId = Citizen::where('citizens_mobile', $mobile)->first();
        $data = Citizen::postCitizenDetailGuest($getId->citizens_id);
        return view('citizen.individualFormSummary', compact('data'));
    }
    public function postAddress(Request $request){
        if($request->ajax()){
            $getMunicipality = Municipality::orderBy('municipalities_name')->get();
            $getBarangay = Barangay::orderBy('barangays_name')->get();
            $getZone = Zone::orderBy('zones_name')->get();
            $data = array(
                'municipality' =>$getMunicipality,
                'barangay' => $getBarangay,
                'zone' =>$getZone,
            );
            return $data;
        }
    }
    public function ajaxMunicipality(Request $request){
        $select_id = $request->get('select_id');
        $data = Municipality::where('province_id', $select_id)->orderBy('municipalities_name', 'ASC')->get();
        return $data;
    }
    public function ajaxBarangay(Request $request){
        $select_id = $request->get('select_id');
        $data = Barangay::where('municipalities_id', $select_id)->orderBy('barangays_name', 'ASC')->get();
        return $data;
    }
    public function ajaxZone(Request $request){
        $select_id = $request->get('select_id');
        $data = Zone::where('barangays_id', $select_id)->orderBy('zones_name', 'ASC')->get();
        return $data;
    }
    public function postCitizen(Request $request){  
        if(Citizen::postCheck($request)){
            // return redirect()->back()->with('hasData','The system detected that you have been registered.');
            return "exist";
        }else{
            Citizen::postCitizen($request);
            Citizen::postVerification($request->number);
            return "true";
        }
    }
    public function postCode(Request $request){
        $codeSession = session('verification');
        $postCode = Citizen::postCode($codeSession, $request);
        return $postCode;
    }
    public function ajaxResend(Request $request){
        $resend = Citizen::resend($request);
        return $resend;
    }
    public function ajaxCheckMobile(Request $request){
        $validate = Citizen::checkMobile($request);
        return $validate;
    }
    //--- citizen registration form (end)

    


}
