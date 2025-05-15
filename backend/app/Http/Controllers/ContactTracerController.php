<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Symptoms;
use App\Tag;
use App\Tag_Description;
use App\Citizen;
use App\Monitor;
use App\Monitor_Type;
use App\Monitor_Record;
use App\Trace;
use App\Facility;
use Illuminate\Support\Facades\DB;

class ContactTracerController extends Controller
{
    public function getSymtoms(){
        return view('contact-tracer.admin_ctc_symptoms');
    }
    public function getFacility(){
        return view('contact-tracer.admin_ctc_facility');
    }
    public function getTagging(){
        $descriptions = Tag_Description::get();
        return view('contact-tracer.admin_ctc_tagging', compact('descriptions'));
    }
    public function getMonitor(){
        $types = Monitor_Type::get();
        $tag_desc = Tag_Description::get();
        $symptoms = Symptoms::get();
        $facility = Facility::get();
        return view('contact-tracer.admin_ctc_monitor', compact('types','symptoms', 'facility', 'tag_desc'));
    }
    public function GetTableSymptoms(){
        $data = Symptoms::get();
        return response()->json([
            "data" => $data
        ]);
    }
    public function GetTableFacility(){
        $data = Facility::get();

        return response()->json([
            "data" => $data
        ]);

    }
    public function GetTableTagging(Request $request){
        return Tag::getTableTagging($request);
    }
    public function GetTableMonitor(Request $request){
        $gender = 'All'; $descriptions = ''; $facility =''; $status = '';
        // return $request;

        if($request['gender'] != null){
            $gender = $request['gender'];
        }
        if($request['description'] != null){
            $descriptions = $request['description'];
        }
        if($request['facility'] != null){
            $facility = $request['facility'];
        }
        if($request['status'] != null){
            $status = $request['status'];
        }

        session()->put('monitor_gender', $gender);
        session()->put('monitor_descriptions', $descriptions);
        session()->put('monitor_facility', $facility);
        session()->put('monitor_status', $status);

        if($gender != "All"){
            $data = DB::table('monitors')
            ->join('facilities', 'facilities.facilities_id' , '=' , 'monitors.facilities_id')
            ->join('monitor_types', 'monitor_types.monitor_types_id' , '=' , 'monitors.monitor_types_id')
            ->join('tags', 'tags.tags_id' , '=' , 'monitors.tags_id')
            ->join('tag_description', 'tag_description.tag_desc_id' , '=' , 'tags.tag_desc_id')
            ->join('citizens', 'citizens.citizens_id' , '=' , 'tags.citizens_id');

            $data->where('citizens.citizens_gender', $gender);
            
            if($descriptions != ''){
                $data->where('tag_description.tag_desc_id', $descriptions);
            }

            if($status != ''){
                $data->where('monitors.monitor_types_id', $status);
            }

            if($facility != ''){
                $data->where('monitors.facilities_id', $facility);
            }

            $data = $data ->get();
            return response()->json([
                "data" => $data
            ]);
        }

        $data = DB::table('monitors')
        ->join('facilities', 'facilities.facilities_id' , '=' , 'monitors.facilities_id')
        ->join('monitor_types', 'monitor_types.monitor_types_id' , '=' , 'monitors.monitor_types_id')
        ->join('tags', 'tags.tags_id' , '=' , 'monitors.tags_id')
        ->join('tag_description', 'tag_description.tag_desc_id' , '=' , 'tags.tag_desc_id')
        ->join('citizens', 'citizens.citizens_id' , '=' , 'tags.citizens_id');
        
        if($descriptions != ''){
            $data->where('tag_description.tag_desc_id', $descriptions);
        }

        if($status != ''){
            $data->where('monitors.monitor_types_id', $status);
        }

        if($facility != ''){
            $data->where('monitors.facilities_id', $facility);
        }

        $data = $data->get();

        return response()->json([
            "data" => $data
        ]);
    }
    public function GetCitizen(Request $request){
        $search = $request->search;

        $citizen = DB::table('tags')
        ->rightJoin('citizens', 'citizens.citizens_id', '=' ,'tags.citizens_id')
        ->rightJoin('tag_description', 'tag_description.tag_desc_id', '=' ,'tags.tag_desc_id');
        if($search == ''){
           $citizen = Citizen::orderBy('citizens_fname')
            ->get();
        }else{
           $citizen = Citizen::where('citizens_fname','LIKE','%'.$search.'%')
           ->orWhere('citizens_mname','LIKE','%'. $search . '%')
           ->orWhere('citizens_lname','LIKE','%'. $search . '%')
           ->orWhere('citizens_suffix','LIKE','%'. $search . '%')
           ->orderBy('citizens_fname')
           ->get();
        }
  
        $response = array();
        foreach($citizen as $ct){
            if($ct->citizens_suffix != null){
                $response[] = array(
                    "id"=>$ct->citizens_id,
                    "text"=>$ct->citizens_fname. ' ' . $ct->citizens_mname  .' ' . $ct->citizens_lname . ' ' . $ct->citizens_suffix
               );
            }else{
                $response[] = array(
                    "id"=>$ct->citizens_id,
                    "text"=>$ct->citizens_fname. ' ' . $ct->citizens_mname  .' ' . $ct->citizens_lname
               );
            }
         
        }
        return json_encode($response);
    }
    public function postNewTag(Request $request){

        if(Tag::checkTag($request)){
            return "exist";
        }
        else{
            Tag::newTag($request);
            $traceData = Trace::getSuspects();
            return "success";
            //return $traceData;
            //return Tag::sendMessage($request);
            
        }

    }
    public function postNewSymptom(Request $request){
        $data = [
            ['symptoms_description' => $request->sname]
        ];
        Symptoms::insert($data);
        return true;
    }
    public function GetCitizenHasTag(Request $request){
        $search = $request->search;

        $citizen = DB::table('monitors')
        ->rightJoin('tags', 'tags.tags_id', '=' ,'monitors.tags_id')
        ->rightJoin('tag_description', 'tag_description.tag_desc_id', '=' ,'tags.tag_desc_id')
        ->rightJoin('citizens', 'citizens.citizens_id', '=' , 'tags.citizens_id');
        if($search == ''){
            $citizen = $citizen
            ->whereNull('monitors.monitors_id')
            ->whereIn('tags.tag_desc_id',[3,4,6,8])
            ->groupBy('citizens.citizens_id')
            ->get();
        }else{
            $citizen = $citizen
            ->whereNull('monitors.monitors_id')
            ->whereIn('tags.tag_desc_id',[3,4,6,8])
            ->where('citizens.citizens_fname','LIKE','%'.$search.'%')
            ->where('citizens.citizens_mname','LIKE','%'. $search . '%')
            ->where('citizens.citizens_lname','LIKE','%'. $search . '%')
            ->where('citizens.citizens_suffix','LIKE','%'. $search . '%')
            ->groupBy('citizens.citizens_id')
            ->get();
        }

        $response = array();
        foreach($citizen as $ct){

            if($ct->citizens_suffix != null){
                $response[] = array(
                    "id"=>$ct->tags_id,
                    "text"=>$ct->citizens_fname. ' ' . $ct->citizens_mname  .' ' . $ct->citizens_lname . ' ' . $ct->citizens_suffix
               );
            }else{
                $response[] = array(
                    "id"=>$ct->tags_id,
                    "text"=>$ct->citizens_fname. ' ' . $ct->citizens_mname  .' ' . $ct->citizens_lname
               );
            }
         
        }
        return json_encode($response);
    }
    public function postNewMonitor(Request $request){
        if(Monitor::checkMonitor($request)){
            return "exist";
        }else{
            Monitor::postNewMonitor($request);
            if($request->symptoms != "0"){
                Monitor_Record::newMonitorRecord($request);
                return "success";
            }else{
                return "success";
            }
        }
        return $request;
    }
    public function downloadNoFilterTagging(){
        date_default_timezone_set('Asia/Manila');
        $date = date('M j, Y g:i a');

        $data = DB::table('citizens')
        ->join('tags', 'citizens.citizens_id', '=' , 'tags.citizens_id')
        ->join('tag_description', 'tag_description.tag_desc_id', '=', 'tags.tag_desc_id')
        ->join('users', 'tags.users_id', '=' , 'users.users_id')
        ->join('provinces', 'provinces.province_id', '=', 'citizens.province_id_current')
        ->join('municipalities', 'municipalities.municipalities_id', '=', 'citizens.municipalities_id_current')
        ->join('barangays', 'barangays.barangays_id', '=', 'citizens.barangays_id_current')
        ->join('zones', 'zones.zones_id', '=', 'citizens.zones_id_current');

        $data = $data 
        -> groupBy('citizens.citizens_id', 'tag_description.tag_desc_id')
        -> get();

        // return view('layouts.layout_generate_tagging', compact('date','data'));

        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_header' => 10,
            'margin_footer' => 8,
            'format' => 'A4-L',
        ]);
        $html = \View::make('layouts.layout_generate_tagging',compact('data', 'date'));
        $html = $html->render();
        $mpdf->SetFooter('Page {PAGENO}');
        $stylesheet = file_get_contents('css/AdminCSS/pdfCSS.css');
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Tagging-'.date('(Y-m-d) h:i:s A').'.pdf', 'D');

    }
    public function downloadFilterTagging(){
        date_default_timezone_set('Asia/Manila');
        $date = date('M j, Y g:i a');

        $gender = session()->get('tag_gender');
        $descriptions = session()->get('tag_descriptions');

        if($gender != 'All'){
            $data = DB::table('citizens')
            ->join('tags', 'citizens.citizens_id', '=' , 'tags.citizens_id')
            ->join('tag_description', 'tag_description.tag_desc_id', '=', 'tags.tag_desc_id')
            ->join('users', 'tags.users_id', '=' , 'users.users_id')
            ->join('provinces', 'provinces.province_id', '=', 'citizens.province_id_current')
            ->join('municipalities', 'municipalities.municipalities_id', '=', 'citizens.municipalities_id_current')
            ->join('barangays', 'barangays.barangays_id', '=', 'citizens.barangays_id_current')
            ->join('zones', 'zones.zones_id', '=', 'citizens.zones_id_current')
            ->where('citizens.citizens_gender', '=' , $gender);

            if($descriptions != ''){
                $data = $data -> where('tags.tag_desc_id', '=' , $descriptions);
            }
            
            $data = $data 
            -> groupBy('citizens.citizens_id', 'tag_description.tag_desc_id')
            -> get();

            $mpdf = new \Mpdf\Mpdf([
                'margin_left' => 10,
                'margin_right' => 10,
                'margin_top' => 10,
                'margin_bottom' => 10,
                'margin_header' => 10,
                'margin_footer' => 8,
                'format' => 'A4-L',
            ]);
            $html = \View::make('layouts.layout_generate_tagging',compact('data', 'date'));
            $html = $html->render();
            $mpdf->SetFooter('Page {PAGENO}');
            $stylesheet = file_get_contents('css/AdminCSS/pdfCSS.css');
            $mpdf->WriteHTML($stylesheet,1);
            $mpdf->WriteHTML($html);
            $mpdf->Output('Tagging-'.date('(Y-m-d) h:i:s A').'.pdf', 'D');
        }

        $data = DB::table('citizens')
        ->join('tags', 'citizens.citizens_id', '=' , 'tags.citizens_id')
        ->join('tag_description', 'tag_description.tag_desc_id', '=', 'tags.tag_desc_id')
        ->join('users', 'tags.users_id', '=' , 'users.users_id')
        ->join('provinces', 'provinces.province_id', '=', 'citizens.province_id_current')
        ->join('municipalities', 'municipalities.municipalities_id', '=', 'citizens.municipalities_id_current')
        ->join('barangays', 'barangays.barangays_id', '=', 'citizens.barangays_id_current')
        ->join('zones', 'zones.zones_id', '=', 'citizens.zones_id_current');

        if($descriptions != ''){
            $data = $data -> where('tags.tag_desc_id', '=' , $descriptions);
        }

        $data = $data 
        -> groupBy('citizens.citizens_id', 'tag_description.tag_desc_id')
        -> get();

        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_header' => 10,
            'margin_footer' => 8,
            'format' => 'A4-L',
        ]);
        $html = \View::make('layouts.layout_generate_tagging',compact('data', 'date'));
        $html = $html->render();
        $mpdf->SetFooter('Page {PAGENO}');
        $stylesheet = file_get_contents('css/AdminCSS/pdfCSS.css');
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Tagging-'.date('(Y-m-d) h:i:s A').'.pdf', 'D');   
    }
    public function postViewMonitor(Request $request){
        $data = DB::table('monitors')
        ->join('monitor_types', 'monitor_types.monitor_types_id', '=' , 'monitors.monitor_types_id')
        ->join('tags', 'tags.tags_id', '=' , 'monitors.tags_id')
        ->join('facilities', 'facilities.facilities_id', '=' , 'monitors.facilities_id')
        ->join('tag_description', 'tag_description.tag_desc_id', '=', 'tags.tag_desc_id')
        ->join('citizens', 'citizens.citizens_id', '=' , 'tags.citizens_id')
        ->join('provinces', 'provinces.province_id', '=', 'citizens.province_id_current')
        ->join('municipalities', 'municipalities.municipalities_id', '=', 'citizens.municipalities_id_current')
        ->join('barangays', 'barangays.barangays_id', '=', 'citizens.barangays_id_current')
        ->join('zones', 'zones.zones_id', '=', 'citizens.zones_id_current')
        ->where('monitors.monitors_id', $request['monitor_id'])
        ->get();

        $monitor_record = DB::table('monitor_records')
        ->join('symptoms', 'symptoms.symptoms_id', '=' , 'monitor_records.symptoms_id')
        ->where('monitor_records.monitors_id', $request['monitor_id'])
        ->get();

        return response()->json([
            "data" => $data,
            "record" => $monitor_record
        ]);

    }
    public function downloadNoFilterMonitoring(Request $request){
        date_default_timezone_set('Asia/Manila');
        $date = date('M j, Y g:i a');

        $data = DB::table('monitors')
        ->join('facilities', 'facilities.facilities_id' , '=' , 'monitors.facilities_id')
        ->join('monitor_types', 'monitor_types.monitor_types_id' , '=' , 'monitors.monitor_types_id')
        ->join('tags', 'tags.tags_id' , '=' , 'monitors.tags_id')
        ->join('tag_description', 'tag_description.tag_desc_id' , '=' , 'tags.tag_desc_id')
        ->join('citizens', 'citizens.citizens_id' , '=' , 'tags.citizens_id')
        ->join('provinces', 'provinces.province_id', '=', 'citizens.province_id_current')
        ->join('municipalities', 'municipalities.municipalities_id', '=', 'citizens.municipalities_id_current')
        ->join('barangays', 'barangays.barangays_id', '=', 'citizens.barangays_id_current')
        ->join('zones', 'zones.zones_id', '=', 'citizens.zones_id_current')->get();
        
        // return view('layouts.layout_generate_monitor', compact('date', 'data'));

        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_header' => 10,
            'margin_footer' => 8,
            'format' => 'A4-L',
        ]);
        $html = \View::make('layouts.layout_generate_monitor',compact('data', 'date'));
        $html = $html->render();
        $mpdf->SetFooter('Page {PAGENO}');
        $stylesheet = file_get_contents('css/AdminCSS/pdfCSS.css');
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Monitoring-'.date('(Y-m-d) h:i:s A').'.pdf', 'D');
    }
    public function downloadFilterMonitoring(Request $request){
        date_default_timezone_set('Asia/Manila');
        $date = date('M j, Y g:i a');

        $gender = session()->get('monitor_gender');
        $descriptions = session()->get('monitor_descriptions');
        $facility = session()->get('monitor_facility');
        $status = session()->get('monitor_status');

        if($gender != "All"){
            $data = DB::table('monitors')
            ->join('facilities', 'facilities.facilities_id' , '=' , 'monitors.facilities_id')
            ->join('monitor_types', 'monitor_types.monitor_types_id' , '=' , 'monitors.monitor_types_id')
            ->join('tags', 'tags.tags_id' , '=' , 'monitors.tags_id')
            ->join('tag_description', 'tag_description.tag_desc_id' , '=' , 'tags.tag_desc_id')
            ->join('citizens', 'citizens.citizens_id' , '=' , 'tags.citizens_id')
            ->join('provinces', 'provinces.province_id', '=', 'citizens.province_id_current')
            ->join('municipalities', 'municipalities.municipalities_id', '=', 'citizens.municipalities_id_current')
            ->join('barangays', 'barangays.barangays_id', '=', 'citizens.barangays_id_current')
            ->join('zones', 'zones.zones_id', '=', 'citizens.zones_id_current');

            $data->where('citizens.citizens_gender', $gender);
            if($descriptions != ''){
                $data->where('tag_description.tag_desc_id', $descriptions);
            }
            if($status != ''){
                $data->where('monitors.monitor_types_id', $status);
            }
            if($facility != ''){
                $data->where('monitors.facilities_id', $facility);
            }
            $data = $data ->get();
            
            $mpdf = new \Mpdf\Mpdf([
                'margin_left' => 10,
                'margin_right' => 10,
                'margin_top' => 10,
                'margin_bottom' => 10,
                'margin_header' => 10,
                'margin_footer' => 8,
                'format' => 'A4-L',
            ]);
            $html = \View::make('layouts.layout_generate_monitor',compact('data', 'date'));
            $html = $html->render();
            $mpdf->SetFooter('Page {PAGENO}');
            $stylesheet = file_get_contents('css/AdminCSS/pdfCSS.css');
            $mpdf->WriteHTML($stylesheet,1);
            $mpdf->WriteHTML($html);
            $mpdf->Output('Monitoring-'.date('(Y-m-d) h:i:s A').'.pdf', 'D');
        }

        $data = DB::table('monitors')
        ->join('facilities', 'facilities.facilities_id' , '=' , 'monitors.facilities_id')
        ->join('monitor_types', 'monitor_types.monitor_types_id' , '=' , 'monitors.monitor_types_id')
        ->join('tags', 'tags.tags_id' , '=' , 'monitors.tags_id')
        ->join('tag_description', 'tag_description.tag_desc_id' , '=' , 'tags.tag_desc_id')
        ->join('citizens', 'citizens.citizens_id' , '=' , 'tags.citizens_id')
        ->join('provinces', 'provinces.province_id', '=', 'citizens.province_id_current')
        ->join('municipalities', 'municipalities.municipalities_id', '=', 'citizens.municipalities_id_current')
        ->join('barangays', 'barangays.barangays_id', '=', 'citizens.barangays_id_current')
        ->join('zones', 'zones.zones_id', '=', 'citizens.zones_id_current');

        if($descriptions != ''){
            $data->where('tag_description.tag_desc_id', $descriptions);
        }
        if($status != ''){
            $data->where('monitors.monitor_types_id', $status);
        }
        if($facility != ''){
            $data->where('monitors.facilities_id', $facility);
        }
        $data = $data->get();

        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_header' => 10,
            'margin_footer' => 8,
            'format' => 'A4-L',
        ]);
        $html = \View::make('layouts.layout_generate_monitor',compact('data', 'date'));
        $html = $html->render();
        $mpdf->SetFooter('Page {PAGENO}');
        $stylesheet = file_get_contents('css/AdminCSS/pdfCSS.css');
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Monitoring-'.date('(Y-m-d) h:i:s A').'.pdf', 'D');

    }

    public function newtrace(){
        return Trace::getSuspects();
    }

}
