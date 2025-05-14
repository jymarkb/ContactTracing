<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Citizen;
use App\Tag;
use App\Barangay;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Scan;


class CommonController extends Controller
{
    
    //--- citizen i-card (start)
    public function getIcard(){
        session()->forget('id_p_number');
        return view('citizen-icard.citizen_form');
    }
    public function getIcardVerification(){
        if(session()->has('id_p_number')){
            return view('citizen-icard.citizen_verification');
        }else{
            return view('citizen-icard.citizen_form');
        }   
    }
    public function getIcardDownload(){
        if(session()->has('id_p_number')){
            $data = Citizen::generateCitizenICard();
            return view('citizen-icard.citizen_id', compact('data'));
        }else{
            return view('citizen-icard.citizen_form');
        }
        
    }

    public function ajaxCheckNumberID(Request $request){
        return Citizen::checkNumberICard($request);
    }
    public function ajaxCheckCodeID(Request $request){
        return Citizen::checkCodeICard($request);
    }
    public function ajaxResendCodeID(Request $request){
        return Citizen::resendVerificationICard();
    }
    //--- citizen i-card (end)

    //--- citizen tracking (start)
    public function getTracking(){
        session()->forget('tracking_p_number');
        return view('citizen-tracking.citizen_form');
    }
    public function getTrackingVerification(){
        if(session()->has('tracking_p_number')){
            return view('citizen-tracking.citizen_verification');
        }else{
            return view('citizen-tracking.citizen_form');
        }   
    }
    public function getTrackingRecord(){
        if(session()->has('tracking_p_number')){
            $citizen = Citizen::generateCitizenTracking();
            $newDate = Carbon::now();
            $curDate = date_format($newDate, "l, m-d-Y | h:m A");

            return view('citizen-tracking.citizen_record', compact('citizen', 'curDate'));
        }else{
            return view('citizen-tracking.citizen_form');
        }  
    }
    public function getHistoryRecord(){
        if(session()->has('tracking_p_number')){
            $citizen = Citizen::generateCitizenTracking();
            $history = Scan::where('citizens_id',$citizen->citizens_id)->with('ScanToEstablishment')->get();

            return response()->json([
                "data" => $history
            ]);
        }

    }

    public function ajaxCheckNumberTracking(Request $request){
        return Citizen::checkNumberTracking($request);
    }
    public function ajaxCheckCodeTracking(Request $request){
        return Citizen::checkCodeTracking($request);
    }
    public function ajaxResendCodeTracking(Request $request){
        return Citizen::resendVerificationTracking();
    }
    //--- citizen tracking (end)

    public function syncmap(){
        $data = DB::table('citizens')
        ->join('tags', 'citizens.citizens_id', '=' , 'tags.citizens_id')
        ->where('tag_desc_id', '=' , 6)
        ->get();

        return $data;
    }
    public function mapinfo(Request $request){
        $data = DB::table('citizens')
        ->join('tags', 'citizens.citizens_id', '=' , 'tags.citizens_id')
        ->where('tag_desc_id', '=' , 6)
        ->where('barangays_id_current', '=' , $request->brgy)
        ->count();
        $getBrgy = Barangay::where('barangays_id', '=', $request->brgy)->first();



        return response()->json([
            "count" => $data,
            "name" => $getBrgy->barangays_name
        ]);
    }

    public function mapCitizen(){
        return view('citizen.map');
    }
    
}
