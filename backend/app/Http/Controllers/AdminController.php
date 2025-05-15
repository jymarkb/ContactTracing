<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Province;
use App\Municipality;
use App\Barangay;
use App\Zone;
use App\Citizen;
use App\Establishment;
use Illuminate\Support\Facades\Crypt;
use Mpdf\Mpdf;
use App\Scan;

class AdminController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    //------ admin
    public function getLoginAdmin(){
        return view('admin.new');
    }
    public function getDashboard(){
        return view ('admin.admin_dashboard');
    }

    //------ admin (citizen start)
    public function getCitizenAddNew(){
        $province = Province::orderBy('province_name', 'ASC')->get();
        $data = array(
            'province' => $province,
            'curProvince' =>$province
        );
        return view ('admin.admin_citizen_addnew')->with($data);
    }
    public function getCitizenRecord(){
        $getProvince = Province::orderBy('province_name')->get();
        return view ('admin.admin_citizen_record', compact('getProvince'));
    }
    public function getCitizenInfo(Request $request){
        $gender = 'all'; $verification = 'all';
        $per_province = '';$per_municipality = '';$per_barangay = '';$per_zone = '';
        $cur_province = '';$cur_municipality = '';$cur_barangay = '';$cur_zone = '';

        if($request->gender != ''){
            $gender = $request->gender;
        }
        if($request->verification != ''){
            $verification = $request->verification;
        }
        if($request->p_province != 0){
            $per_province = $request->p_province ;
        }
        if($request->p_municipality != 0){
            $per_municipality = $request->p_municipality ;
        }
        if($request->p_barangay != 0){
            $per_barangay = $request->p_barangay ;
        }
        if($request->p_zone != 0){
            $per_zone = $request->p_zone ;
        }
        if($request->c_province != 0){
            $cur_province = $request->c_province ;
        }
        if($request->c_municipality != 0){
            $cur_municipality = $request->c_municipality ;
        }
        if($request->c_barangay != 0){
            $cur_barangay = $request->c_barangay ;
        }
        if($request->c_zone != 0){
            $cur_zone = $request->c_zone ;
        }
        if($gender != 'all'){
            $data = Citizen::query();
            $data = $data->where('citizens_gender', $gender);
            if($per_province != '' && $per_municipality != '' && $per_barangay != '' && $per_zone != ''){
                $data = $data->where([
                    ['province_id', $per_province],
                    ['municipalities_id', $per_municipality],
                    ['barangays_id', $per_barangay],
                    ['zones_id', $per_zone],
                ]);
            }
            if($per_province != '' && $per_municipality != '' && $per_barangay != ''){
                $data = $data->where([
                    ['province_id', $per_province],
                    ['municipalities_id', $per_municipality],
                    ['barangays_id', $per_barangay],
                ]);
            }
            if($per_province != '' && $per_municipality != ''){
                $data = $data->where([
                    ['province_id', $per_province],
                    ['municipalities_id', $per_municipality],
                ]);
            }
            if($per_province != ''){
                $data = $data->where('province_id', $per_province);
            }
            if($cur_province != '' && $cur_municipality != '' && $cur_barangay != '' && $cur_zone != ''){
                $data = $data->where([
                    ['province_id_current', $cur_province],
                    ['municipalities_id_current', $cur_municipality],
                    ['barangays_id_current', $cur_barangay],
                    ['zones_id_current', $cur_zone],
                ]);
            }
            if($cur_province != '' && $cur_municipality != '' && $cur_barangay != ''){
                $data = $data->where([
                    ['province_id_current', $cur_province],
                    ['municipalities_id_current', $cur_municipality],
                    ['barangays_id_current', $cur_barangay],
                ]);
            }
            if($cur_province != '' && $cur_municipality != ''){
                $data = $data->where([
                    ['province_id_current', $cur_province],
                    ['municipalities_id_current', $cur_municipality],
                ]);
            }
            if($cur_province != ''){
                $data = $data->where('province_id_current', $cur_province);
            }
            if($verification !='all'){
                $data = $data->where('verifications_id', $verification);
            }

            $data = $data->with([
                'CitizenToProvince',
                'CitizenToMunicipality', 
                'CitizenToBarangay',
                'CitizenToZone',
                'CitizenToVerify',
                'getMainProvince',
                'getMainMunicipality',
                'getMainBarangay',
                'getMainZone'
            ])->orderBy('citizens_fname', 'ASC')->get();

            return response()->json([
                "data" => $data
            ]);
            
        }
        else{
            $data = Citizen::query();
            if($per_province != '' && $per_municipality != '' && $per_barangay != '' && $per_zone != ''){
                $data = $data->where([
                    ['province_id', $per_province],
                    ['municipalities_id', $per_municipality],
                    ['barangays_id', $per_barangay],
                    ['zones_id', $per_zone],
                ]);
            }
            if($per_province != '' && $per_municipality != '' && $per_barangay != ''){
                $data = $data->where([
                    ['province_id', $per_province],
                    ['municipalities_id', $per_municipality],
                    ['barangays_id', $per_barangay],
                ]);
            }
            if($per_province != '' && $per_municipality != ''){
                $data = $data->where([
                    ['province_id', $per_province],
                    ['municipalities_id', $per_municipality],
                ]);
            }
            if($per_province != ''){
                $data = $data->where('province_id', $per_province);
            }          
            if($cur_province != '' && $cur_municipality != '' && $cur_barangay != '' && $cur_zone != ''){
                $data = $data->where([
                    ['province_id_current', $cur_province],
                    ['municipalities_id_current', $cur_municipality],
                    ['barangays_id_current', $cur_barangay],
                    ['zones_id_current', $cur_zone],
                ]);
            }
            if($cur_province != '' && $cur_municipality != '' && $cur_barangay != ''){
                $data = $data->where([
                    ['province_id_current', $cur_province],
                    ['municipalities_id_current', $cur_municipality],
                    ['barangays_id_current', $cur_barangay],
                ]);
            }
            if($cur_province != '' && $cur_municipality != ''){
                $data = $data->where([
                    ['province_id_current', $cur_province],
                    ['municipalities_id_current', $cur_municipality],
                ]);
            }
            if($cur_province != ''){
                $data = $data->where('province_id_current', $cur_province);
            }
            if($verification !='all'){
                $data = $data->where('verifications_id', $verification);
            }

            $data = $data->with([
                'CitizenToProvince',
                'CitizenToMunicipality', 
                'CitizenToBarangay',
                'CitizenToZone',
                'CitizenToVerify',
                'getMainProvince',
                'getMainMunicipality',
                'getMainBarangay',
                'getMainZone'
            ])->orderBy('citizens_fname', 'ASC')->get();

            return response()->json([
                "data" => $data
            ]);
        }
    }
    public function getCitizenId(){
        $citizen = Citizen::all();
        $data = array(
            'citi' => $citizen,
        );
        return view ('admin.admin_citizen_idcard')->with($data);
    }
    public function getGenerateDownload(Request $request){
        $generated = Citizen::generateDownloadCitizen($request);
        if(!$generated->isEmpty()){
            return 'true';
        }else{
            return 'false';
        }  
    }
    public function downloadFilterCitizen(){
        date_default_timezone_set('Asia/Manila');
        ini_set('max_execution_time', '300');
        ini_set("pcre.backtrack_limit", "5000000");
        ini_set('memory_limit', '1024M');
        $date = date('M j, Y g:i a');
        $data = Citizen::downloadFilterCitizen();

        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_header' => 10,
            'margin_footer' => 8,
            'format' => 'A4-L',
        ]);
        $html = \View::make('layouts.layout_generate_citizen',compact('data', 'date'));
        $html = $html->render();
        $mpdf->SetFooter('Page {PAGENO}');
        $stylesheet = file_get_contents('css/AdminCSS/pdfCSS.css');
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Citizen - '.date('(Y-m-d) h:i:s A').'.pdf', 'D');
        // return view('layouts.layout_generate_citizen',compact('data','date'));
    }
    public function downloadNoFilterCitizen(){
        date_default_timezone_set('Asia/Manila');
        ini_set('max_execution_time', '300');
        ini_set("pcre.backtrack_limit", "5000000");
        ini_set('memory_limit', '1024M');

        $date = date('M j, Y g:i a');
        $data = Citizen::downloadNoFilterCitizen();
        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_header' => 10,
            'margin_footer' => 8,
            'format' => 'A4-L',
        ]);
        $html = \View::make('layouts.layout_generate_citizen',compact('data', 'date'));
        $html = $html->render();
        $mpdf->SetFooter('Page {PAGENO}');
        $stylesheet = file_get_contents('css/AdminCSS/pdfCSS.css');
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Citizen - '.date('(Y-m-d) h:i:s A').'.pdf', 'D');
        // return view('layouts.layout_generate_citizen',compact('data','date'));
    }
    public function postCitizenAdd(Request $request){
        // return $request;
        if(Citizen::postCheck($request)){
            return 'false';
        }else{
            Citizen::postCitizen($request);
            Citizen::verifiedCitizen($request->number);
            $mobile = $request->number;
            $generatedCitizen = Citizen::generateCitizen($mobile);
            $id = $generatedCitizen->citizens_id;
            $generatedID = Citizen::generateId($id);
            return 'true';
        }
    }
    public function postCitizenSelect(Request $request){
        $data = Citizen::postCitizenDetail($request);
        return $data;
    }
    public function postCitizenUpdate(Request $request){
        $hasData = Citizen::postCheckCitizenUpdate($request);
        if($hasData == 'false'){
            $update = Citizen::postUpdate($request);
            return 'true';
        }else{
            if($hasData != $request['edt_ct_id']){
                return 'error';
            }else{
                $update = Citizen::postUpdate($request);
                return 'true';
            }
        }
    }
    public function postBlockCitizen(Request $request){
        if(Citizen::postBlockCitizen($request)){
            return 'true';
        }else{
            return 'false';
        } 
    }
    public function postUnBlockCitizen(Request $request){
        if(Citizen::postUnBlockCitizen($request)){
            return 'true';
        }else{
            return 'false';
        } 
    }
    
    //------ admin (citizen end)

    //------ admin (establishment start)
    public function getEstablishmentAddNew(){
        $data = Barangay::where('municipalities_id','361')->get();
        return view('admin.admin_establishment_addnew', compact('data'));
    }
    public function getEstablishmentRecords(){
        $brgy = Barangay::where('municipalities_id','361')->get();
        return view('admin.admin_establishment_records', compact('brgy'));
    }
    public function getScanner(){
        $es = Establishment::get();
        return view('admin.admin_establishment_scanner', compact('es'));
    }

    public function ajaxCheckMobileES(Request $request){
        $checkNumber = User::where('users_mobile', $request->numberValue)->first();
        if($checkNumber != null){
            return 'has';
        }else{
            return 'none';
        }
    }
    public function EstablishmentAddNew(Request $request){
        if(Establishment::checkExist($request)){
            return "exist";
        }else{
            Establishment::EstablishmentAddNew($request);
            return "success";
        }
    }
    public function EstablishmentSelect(Request $request){
        $data = Establishment::getEstablishmentData($request);
        return $data;
    }
    public function EstablishmentUpdate(Request $request){
        if(Establishment::CheckExistUpdate($request)){
            return "exist";
        }else{
            Establishment::EstablishmentUpdate($request);
            return "success";
        }   
    }
    public function downloadES(){
        Establishment::getTableES();
    }
    public function getESinfo(Request $request){
        $data = Establishment::with(['EstablishmentToUser', 'getBrgy', 'getZone'])->get();
        return response()->json([
            "data" => $data
        ]);
    }
    public function getESscanner(Request $request){
        return Scan::getESscanner($request);
    }
    public function ScannerDefault(){
        $data = Scan::with(['ScanToCitizen', 'ScanToEstablishment'])->get();
        return $data;
    }
    public function EstablishmentView(Request $request){
        $data = Establishment::where('establishments_id', $request['select_id'])
        ->with('getBrgy','getZone','EstablishmentToUser','EstablishmentToUser.Type')
        ->first();
        return $data;
    }

    public function downloadScannerNoFilter(){
        return Establishment::downloadScannerNoFilter();
    }
    public function downloadScannerFilter(){
        return Establishment::downloadScannerFilter();
    }


    //------ admin (establishment end)

    //------ admin (account start)
    public function getAdminAddNew(){
        return view('admin.admin_account_addnew');
    }
    public function getAdminRecords(){
        return view('admin.admin_account_records');
    }
    public function ajaxCheckNumberAdmin(Request $request){
        $result = User::CheckNumberAdmin($request);
        return $result;
    }
    public function ajaxCheckUsername(Request $request){
        $result = User::CheckUsernameAdmin($request);
        return $result;
    }
    public function AdminAddNew(Request $request){
        if(User::CheckExistAdmin($request)){
            return "exist";
        }else{
            User::AdminAddNew($request);
            return "success";
        }
    }
    public function getAdminTable(Request $request){
        $data = User::with('type')->get();
        return response()->json([
            "data" => $data
        ]);
        
    }
    public function AccountSelect(Request $request){
        $user = User::AccountGetAC($request);
        return $user;
    }
    public function AccountUpdate(Request $request){
        if(User::AccountCheckExistUpdate($request)){
            return "exist";
        }else{
            User::AccountUpdate($request);
            return "success";
        }
    }
    //------ admin (account end)

}
