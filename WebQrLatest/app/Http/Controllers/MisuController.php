<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trace;
use App\Scan;
use Illuminate\Support\Facades\DB;

class MisuController extends Controller
{
    public function getTracing(){
        $data = DB::table('citizens')
        ->join('tags', 'citizens.citizens_id', '=' , 'tags.citizens_id')
        ->join('traces', 'tags.tags_id', '=' ,'traces.tags_id')
        ->join('tag_description', 'tag_description.tag_desc_id', '=', 'tags.tag_desc_id')
        ->join('users', 'tags.users_id', '=' , 'users.users_id')
        ->groupBy('citizens.citizens_id')
        ->get();


        return view('misu.misu-tracing', compact('data'));
    }

    public function getTraceName(Request $request){
        $search = '';

        if($request['search'] != null){
            $search = $request['search'];
        }
        

        $data = DB::table('citizens')
        ->join('tags', 'citizens.citizens_id', '=' , 'tags.citizens_id')
        ->join('traces', 'tags.tags_id', '=' ,'traces.tags_id')
        ->join('tag_description', 'tag_description.tag_desc_id', '=', 'tags.tag_desc_id')
        ->join('users', 'tags.users_id', '=' , 'users.users_id');
        // ->select('citizens.citizens_id AS DT_RowId', 'citizens_fname', 'citizens_mname', 'citizens_lname', 'citizens_suffix')

        if($search != ''){
            $data = $data->where('citizens.citizens_fname', 'like', '%'.$request['search'].'%')
            ->orWhere('citizens.citizens_mname', 'like', '%'.$request['search'].'%')
            ->orWhere('citizens.citizens_lname', 'like', '%'.$request['search'].'%');
        }

        $data = $data->groupBy('citizens.citizens_id')
        ->get();

        return $data;
        // return response()->json([
        //     "data" => $data
        // ]);
    }

    public function selectTrace(Request $request){
        // $data = DB::table('traces')
        // ->where('tags_id', $request->tags_id)
        // ->where('scans_id', '!=', $request->scans_id)
        // ->get();

        // // $tag_id_list = [];
        // // // $scan_id_list = [];
        // // $datalevel2 = [];
        // for($i = 0; $i < count($data); $i++){
        //     array_push($tag_id_list, $data[$i]->tags_id);
        // }
        // $datalevel1 = [];
        // for($i = 0; $i < count($data); $i++){
        //     $citizenScan = Scan::where('scans_id', $data[$i]->scans_id)->with('ScanToCitizen')->first();   
        //     array_push($datalevel1, $citizenScan);
        // }
        
        // return response()->json([
        //     "datalevel1" => $datalevel1,
        // ]);

        $citizenData = DB::table('citizens')
        ->join('provinces', 'provinces.province_id', '=' , 'citizens.province_id_current')
        ->join('municipalities', 'municipalities.municipalities_id', '=' , 'citizens.municipalities_id_current')
        ->join('barangays', 'barangays.barangays_id', '=' , 'citizens.barangays_id_current')
        ->join('zones', 'zones.zones_id', '=' , 'citizens.zones_id_current')
        ->where('citizens.citizens_id',$request['selected_id'])
        ->get();

        $tagData =  DB::table('citizens')
        ->join('tags', 'tags.citizens_id', '=', 'citizens.citizens_id')
        ->join('tag_description', 'tag_description.tag_desc_id', '=', 'tags.tag_desc_id')
        ->where('citizens.citizens_id',$request['selected_id'])
        // ->groupBy('tags.tag_desc_id')
        // ->latest('tags_date_time')
        ->select('tags_date_time', 'tag_desc_name', 'tags.tags_id')
        ->get();

        $listTagID =[];
        for($i = 0; $i < count($tagData); $i++){
            array_push($listTagID, $tagData[$i]->tags_id);
        }

        $traceData = DB::table('traces')
        ->join('scans', 'scans.scans_id', '=' , 'traces.scans_id')
        ->join('establishments' , 'establishments.establishments_id' , '=', 'scans.establishments_id')
        ->join('citizens', 'citizens.citizens_id', '=' , 'scans.citizens_id')
        ->join('provinces', 'provinces.province_id', '=' , 'citizens.province_id_current')
        ->join('municipalities', 'municipalities.municipalities_id', '=' , 'citizens.municipalities_id_current')
        ->join('barangays', 'barangays.barangays_id', '=' , 'citizens.barangays_id_current')
        ->join('zones', 'zones.zones_id', '=' , 'citizens.zones_id_current')
        ->whereIn('tags_id', $listTagID)
        ->where('citizens.citizens_id', '!=' , $request['selected_id'])
        ->groupBy('citizens.citizens_id', 'scans.establishments_id')
        ->get();
        

        $listScan_ID = DB::table('traces')
        ->join('scans', 'scans.scans_id', '=' , 'traces.scans_id')
        ->whereIn('traces.tags_id', $listTagID)
        ->where('scans.citizens_id', '!=', $request['selected_id'])
        ->get();
        
        

        return response()->json([
            "citizensData" => $citizenData,
            "tagData" => $tagData,
            "traceData" =>$traceData,
            "listTagID" =>$listTagID,
            "listScan" =>$listScan_ID
        ]);

        

    }


}
