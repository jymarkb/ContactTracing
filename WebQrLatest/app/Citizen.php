<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Province;
use App\Municipality;
use App\Barangay;
use App\Zone;
use App\Verification;
use App\Tag;
use SimpleSoftwareIO\QrCode\Generator;
use Illuminate\Support\Facades\Crypt;
use Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Request;


class Citizen extends Model
{
    protected $table = "citizens";

    public $primaryKey = 'citizens_id';

    protected $fillable = [
        'citizens_fname',
        'citizens_mname',
        'citizens_lname',
        'citizens_suffix',
        'citizens_bday',
        'citizens_gender',
        'citizens_profession',
        'citizens_mobile',
        'citizens_img_src',
        'citizens_qr_src',
        'province_id',
        'province_id_current',
        'municipalities_id',
        'municipalities_id_current',
        'barangays_id',
        'barangays_id_current',
        'zones_id',
        'zones_id_current',
        'citizen_add_address',
        'citizen_add_address_current',
        'verifications_id'
    ];
    public $timestamps = false;
    public function CitizenToProvince(){
        return $this->hasOne('App\Province','province_id','province_id_current');
    }
    public function CitizenToMunicipality(){
        return $this->hasOne('App\Municipality','municipalities_id','municipalities_id_current');
    }
    public function CitizenToBarangay(){
        return $this->hasOne('App\Barangay','barangays_id','barangays_id_current');
    }
    public function CitizenToZone(){
        return $this->hasOne('App\Zone','zones_id','zones_id_current');
    }
    public function getMainProvince(){
        return $this->hasOne('App\Province','province_id','province_id');
    }
    public function getMainMunicipality(){
        return $this->hasOne('App\Municipality','municipalities_id','municipalities_id');
    }
    public function getMainBarangay(){
        return $this->hasOne('App\Barangay','barangays_id','barangays_id');
    }
    public function getMainZone(){
        return $this->hasOne('App\Zone','zones_id','zones_id');
    }
    public function CitizenToVerify(){
        return $this->hasOne('App\Verification','verifications_id','verifications_id');
    }
    public function citizentag(){
        return $this->hasMany('App\Tag','citizens_id','citizens_id');
    }
    public static function postCheck($request){
        $zoneSelected;$zoneCurSelected;
        $suffix = $request->suffix;
        if($request['perZone1'] > 0 ){
            $zoneSelected = $request['perZone1'];
        }else{
            if($request['perZone2']==null){
                $zoneSelected = null;
            }else{
                $newZone = Zone::where([
                    ['zones_name', '=' , $request['perZone2']],
                    ['barangays_id', '=' , $request['perBarangay']]
                ])->first();
                
                if($newZone != null){
                    $zoneSelected = $newZone->zones_id;
                }else{
                    $newZoneInsert = new Zone();
                    $newZoneInsert->zones_name = $request['perZone2'];
                    $newZoneInsert->barangays_id = $request['perBarangay'];
                    $newZoneInsert->save();

                    $dbZone = Zone::where([
                        ['zones_name', '=' , $request['perZone2']],
                        ['barangays_id', '=' , $request['perBarangay']]
                    ])->first();
                    $zoneSelected = $dbZone->zones_id;
                }

            }
        }
        if($request['curZone1'] > 0 ){
            $zoneCurSelected = $request['curZone1'];
        }else{
            if($request['curZone2']==null){
                $zoneCurSelected = null;
            }else{
                $newCurZone = Zone::where([
                    ['zones_name', '=' , $request['curZone2']],
                    ['barangays_id', '=' , $request['curBarangay']]
                ])->first();
                
                if($newCurZone != null){
                    $zoneCurSelected = $newCurZone->zones_id;
                }else{
                    $newCurZoneInsert = new Zone();
                    $newCurZoneInsert->zones_name = $request['curZone2'];
                    $newCurZoneInsert->barangays_id = $request['curBarangay'];
                    $newCurZoneInsert->save();

                    $dbCurZone = Zone::where([
                        ['zones_name', '=' , $request['curZone2']],
                        ['barangays_id', '=' , $request['curBarangay']]
                    ])->first();
                    $zoneCurSelected = $dbCurZone->zones_id;
                }

            }
        }

        if($suffix == '0'){
            $suffix = null;
        }
        $newCitizen = Citizen::where([
            ['citizens_fname', '=' , $request['first']],
            ['citizens_mname', '=' , $request['middle']],
            ['citizens_lname', '=' , $request['last']],
            ['citizens_suffix', '=' , $suffix ],
            ['citizens_bday', '=' , $request['year']. '-'. $request['month'] . '-'. $request['day']],
            ['citizens_gender', '=' , $request['gender']],
            ['province_id', '=' , $request['perProvince']],
            ['province_id_current', '=' , $request['curProvince']],
            ['municipalities_id', '=' , $request['perMunicipality']],
            ['municipalities_id_current', '=' , $request['curMunicipality']],
            ['barangays_id', '=' , $request['perBarangay']],
            ['barangays_id_current', '=' , $request['curBarangay']],
            ['zones_id', '=' , $zoneSelected],
            ['zones_id_current', '=' , $zoneCurSelected],
            ['citizen_add_address', '=' , $request['perBldg']],
            ['citizen_add_address_current', '=' , $request['curBldg']],
        ])->first();

        if ($newCitizen != null){
            return true;
        }else{
            return false;
        }
    }
    public static function postCitizen($request){
        date_default_timezone_set('Asia/Manila');
        $zoneSelected;$zoneCurSelected;
        $suffix = $request->suffix;
        if($request['perZone1'] > 0 ){
            $zoneSelected = $request['perZone1'];
        }else{
            if($request['perZone2']==null){
                $zoneSelected = null;
            }else{
                $newZone = Zone::where([
                    ['zones_name', '=' , $request['perZone2']],
                    ['barangays_id', '=' , $request['perBarangay']]
                ])->first();
                
                if($newZone != null){
                    $zoneSelected = $newZone->zones_id;
                }else{
                    $newZoneInsert = new Zone();
                    $newZoneInsert->zones_name = $request['perZone2'];
                    $newZoneInsert->barangays_id = $request['perBarangay'];
                    $newZoneInsert->save();

                    $dbZone = Zone::where([
                        ['zones_name', '=' , $request['perZone2']],
                        ['barangays_id', '=' , $request['perBarangay']]
                    ])->first();
                    $zoneSelected = $dbZone->zones_id;
                }

            }
        }
        if($request['curZone1'] > 0 ){
            $zoneCurSelected = $request['curZone1'];
        }else{
            if($request['curZone2']==null){
                $zoneCurSelected = null;
            }else{
                $newCurZone = Zone::where([
                    ['zones_name', '=' , $request['curZone2']],
                    ['barangays_id', '=' , $request['curBarangay']]
                ])->first();
                
                if($newCurZone != null){
                    $zoneCurSelected = $newCurZone->zones_id;
                }else{
                    $newCurZoneInsert = new Zone();
                    $newCurZoneInsert->zones_name = $request['curZone2'];
                    $newCurZoneInsert->barangays_id = $request['curBarangay'];
                    $newCurZoneInsert->save();

                    $dbCurZone = Zone::where([
                        ['zones_name', '=' , $request['curZone2']],
                        ['barangays_id', '=' , $request['curBarangay']]
                    ])->first();
                    $zoneCurSelected = $dbCurZone->zones_id;
                }

            }
        }
        if($suffix == '0'){
            $suffix = null;
        }


        $imgName = time().'-'.date('Ymd').'-img.png';
        $img = $request->file('imgProfile');
    
        if(Citizen::saveProfile($img,$imgName)){
            $data = [
                'citizens_fname' => $request['first'],
                'citizens_mname' => $request['middle'],
                'citizens_lname' => $request['last'],
                'citizens_suffix' => $suffix,
                'citizens_bday' => $request['year']. '-'. $request['month'] . '-'. $request['day'],
                'citizens_gender' => $request['gender'],
                'citizens_profession' => $request['profession'],
                'citizens_mobile' => $request['number'],
                'citizens_img_src' => $imgName,
                'province_id' => $request['perProvince'],
                'province_id_current' => $request['curProvince'],
                'municipalities_id' => $request['perMunicipality'],
                'municipalities_id_current' => $request['curMunicipality'],
                'barangays_id' => $request['perBarangay'],
                'barangays_id_current' => $request['curBarangay'],
                'zones_id' => $zoneSelected,
                'zones_id_current' => $zoneCurSelected,
                'citizen_add_address' => $request['perBldg'],
                'citizen_add_address_current' => $request['curBldg'],
                'verifications_id' => 2
            ];
            Citizen::create($data);
        }
    }

    public static function saveProfile($img, $imgName){
        Image::make($img->getRealPath())->resize(300, 300, function($constraint){
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save(public_path('images/profileid/' . $imgName));

        if (file_exists( public_path('images/profileid/'.$imgName))) {
            return true;
        } else {
            return false;
        }   
    }


    public static function postVerification($number){
        $mobile = $number;
        session()->put('mobile', '+639XXXXXX' . substr($mobile, -3));
        $random = rand(100000,999999);
        session()->put('verification', $random);
        session()->put('citizen_mobile', $mobile);
        Citizen::sendVerificationICard($mobile, $random, '[registration]');


        Citizen::where('citizens_mobile', $mobile)->update(['verifications_id'=>  1]);
        $getId = Citizen::where('citizens_mobile', $mobile)->first();
        Citizen::generateId($getId->citizens_id);
    }


    public static function generateCitizen($number){
        $data = Citizen::where('citizens_mobile', $number)->first();
        return $data;
    }
    public static function generateId($qrdata){
        $qrcode = new Generator;
        $citizen = Crypt::encryptString($qrdata);

        $id_string = "jmb". $qrdata ."520";
        $new_string_code = 'LIBCT-' . substr($citizen, 0, 100) . $id_string. substr($citizen,100,250);

        // session()->put('awit', $new_string_code);
        $data = $qrcode->size(356)->generate($new_string_code);

        // $output_file = '/images/qrcode/img-'. $qrdata .'-' . time().'.svg';
        // Storage::disk('public')->put($output_file, $data); 


        $output_file = 'images/qrcode/img-'. $qrdata .'-' . time().'.svg';
        Storage::disk('qrpublic')->put($output_file, $data); 

        Citizen::where('citizens_id', $qrdata)->update(['citizens_qr_src'=>  $output_file]);
        return $data;
    }
    public static function checkMobile($request){
        $data = Citizen::where('citizens_mobile', $request['numberValue'])->first();
        if($data != null){
            return 'has';
        }else{
            return 'none';
        }
    }
    public static function resend($request){
        if ($request->resend > 0){
            $number = session('citizen_mobile');
            $code = session('verification');
            Citizen::sendVerificationICard($number,$code, '[registration]');
            return "success";
        }
    }
    public static function postCode($codeSession , $request){
        if($codeSession == $request->number){
            $mobile = session('citizen_mobile');
            // Citizen::where('citizens_mobile', $mobile)->update(['verifications_id'=>  1]);
            // $getId = Citizen::where('citizens_mobile', $mobile)->first();
            // Citizen::generateId($getId->citizens_id);
            return redirect()->route('getSummary');
        }else{
            if($request->number == null){
                session()->flash('codeInvalid','Please enter a verification code.');
                return redirect()->back();
            }else{
                session()->flash('codeInvalid','Invalid verification code.');
                return redirect()->back();
            }
        }
    }
    public static function verifiedCitizen($mobile){
        Citizen::where('citizens_mobile', $mobile)->update(['verifications_id' => '1']);
    }
    public static function postCitizenDetail($id){
        $data = Citizen::where('citizens_id',$id->select_id)
        ->with([
                'CitizenToProvince',
                'CitizenToMunicipality', 
                'CitizenToBarangay',
                'CitizenToZone',
                'getMainProvince',
                'getMainMunicipality',
                'getMainBarangay',
                'getMainZone',
            ])
        ->first();
        return $data;
    }
    public static function postCitizenDetailGuest($id){
        $data = Citizen::where('citizens_id',$id)
        ->with([
                'CitizenToProvince',
                'CitizenToMunicipality', 
                'CitizenToBarangay',
                'CitizenToZone',
                'getMainProvince',
                'getMainMunicipality',
                'getMainBarangay',
                'getMainZone',
            ])
        ->get();
        return $data;
    }
    public static function postCheckCitizenUpdate($request){
        $zoneSelected;$zoneCurSelected;
        $suffix = $request->edt_ct_suffix;
        if($request['edt_ct_perZone1'] > 0 ){
            $zoneSelected = $request['edt_ct_perZone1'];
        }else{
            if($request['edt_ct_perZone2']==null){
                $zoneSelected = null;
            }else{
                $newZone = Zone::where([
                    ['zones_name', '=' , $request['edt_ct_perZone2']],
                    ['barangays_id', '=' , $request['edt_ct_curBrgy']]
                ])->first();
                
                if($newZone != null){
                    $zoneSelected = $newZone->zones_id;
                }else{
                    $newZoneInsert = new Zone();
                    $newZoneInsert->zones_name = $request['edt_ct_perZone2'];
                    $newZoneInsert->barangays_id = $request['edt_ct_curBrgy'];
                    $newZoneInsert->save();

                    $dbZone = Zone::where([
                        ['zones_name', '=' , $request['edt_ct_perZone2']],
                        ['barangays_id', '=' , $request['edt_ct_curBrgy']]
                    ])->first();
                    $zoneSelected = $dbZone->zones_id;
                }

            }
        }

        if($request['edt_ct_curZone1'] > 0 ){
            $zoneCurSelected = $request['edt_ct_curZone1'];
        }else{
            if($request['edt_ct_curZone2']==null){
                $zoneCurSelected = null;
            }else{
                $newCurZone = Zone::where([
                    ['zones_name', '=' , $request['edt_ct_curZone2']],
                    ['barangays_id', '=' , $request['edt_ct_curBrgy']]
                ])->first();
                
                if($newCurZone != null){
                    $zoneCurSelected = $newCurZone->zones_id;
                }else{
                    $newCurZoneInsert = new Zone();
                    $newCurZoneInsert->zones_name = $request['edt_ct_curZone2'];
                    $newCurZoneInsert->barangays_id = $request['edt_ct_curBrgy'];
                    $newCurZoneInsert->save();

                    $dbCurZone = Zone::where([
                        ['zones_name', '=' , $request['edt_ct_curZone2']],
                        ['barangays_id', '=' , $request['edt_ct_curBrgy']]
                    ])->first();
                    $zoneCurSelected = $dbCurZone->zones_id;
                }

            }
        }
        if($suffix == '0'){
            $suffix = null;
        }
        $newCitizen = Citizen::where([
            ['citizens_fname', '=' , $request['edt_ct_fname']],
            ['citizens_mname', '=' , $request['edt_ct_mname']],
            ['citizens_lname', '=' , $request['edt_ct_lname']],
            ['citizens_suffix', '=' , $suffix],
            ['citizens_bday', '=' , $request['edt_ct_year']. '-'. $request['edt_ct_month'] . '-'. $request['edt_ct_day']],
            ['citizens_gender', '=' , $request['edt_ct_gender']],
            ['province_id', '=' , $request['edt_ct_perProv']],
            ['province_id_current', '=' , $request['edt_ct_curProv']],
            ['municipalities_id', '=' , $request['edt_ct_perMuni']],
            ['municipalities_id_current', '=' , $request['edt_ct_curMuni']],
            ['barangays_id', '=' , $request['edt_ct_perBrgy']],
            ['barangays_id_current', '=' , $request['edt_ct_curBrgy']],
            ['zones_id', '=' , $zoneSelected],
            ['zones_id_current', '=' , $zoneCurSelected],
            ['citizen_add_address', '=' , $request['edt_ct_perBldg']],
            ['citizen_add_address_current', '=' , $request['edt_ct_curBldg']],
        ])->first();
        

        if($newCitizen != null){
            return $newCitizen->citizens_id;
        }else{
            return 'false';
        }
    }
    public static function postUpdate($request){
        date_default_timezone_set('Asia/Manila');
        $zoneSelected;$zoneCurSelected;
        $suffix = $request->edt_ct_suffix;
        if($request['edt_ct_perZone1'] > 0 ){
            $zoneSelected = $request['edt_ct_perZone1'];
        }else{
            if($request['edt_ct_perZone2']==null){
                $zoneSelected = null;
            }else{
                $newZone = Zone::where([
                    ['zones_name', '=' , $request['edt_ct_perZone2']],
                    ['barangays_id', '=' , $request['edt_ct_perBrgy']]
                ])->first();
                
                if($newZone != null){
                    $zoneSelected = $newZone->zones_id;
                }else{
                    $newZoneInsert = new Zone();
                    $newZoneInsert->zones_name = $request['edt_ct_perZone2'];
                    $newZoneInsert->barangays_id = $request['edt_ct_perBrgy'];
                    $newZoneInsert->save();

                    $dbZone = Zone::where([
                        ['zones_name', '=' , $request['edt_ct_perZone2']],
                        ['barangays_id', '=' , $request['edt_ct_perBrgy']]
                    ])->first();
                    $zoneSelected = $dbZone->zones_id;
                }

            }
        }
        if($request['edt_ct_curZone1'] > 0 ){
            $zoneCurSelected = $request['edt_ct_curZone1'];
        }else{
            if($request['edt_ct_curZone2']==null){
                $zoneCurSelected = null;
            }else{
                $newCurZone = Zone::where([
                    ['zones_name', '=' , $request['edt_ct_curZone2']],
                    ['barangays_id', '=' , $request['edt_ct_curBrgy']]
                ])->first();
                
                if($newCurZone != null){
                    $zoneCurSelected = $newCurZone->zones_id;
                }else{
                    $newCurZoneInsert = new Zone();
                    $newCurZoneInsert->zones_name = $request['edt_ct_curZone2'];
                    $newCurZoneInsert->barangays_id = $request['edt_ct_curBrgy'];
                    $newCurZoneInsert->save();

                    $dbCurZone = Zone::where([
                        ['zones_name', '=' , $request['edt_ct_curZone2']],
                        ['barangays_id', '=' , $request['edt_ct_curBrgy']]
                    ])->first();
                    $zoneCurSelected = $dbCurZone->zones_id;
                }

            }
        }
        if($suffix == '0'){
            $suffix = null;
        }

        if($request->hasFile('edt_ct_photo')){
            $file = $request->edt_ct_photo->getClientOriginalExtension();
            $imgName = time().'-'.date('Ymd').'-img-.'. $file;
            $request->edt_ct_photo->storeAs('images', $imgName, 'public');
            Citizen::where('citizens_id', $request['edt_ct_id'])
            ->update([
                'citizens_img_src' => $imgName
            ]);
        }

        Citizen::where('citizens_id', $request['edt_ct_id'])
        ->update([
            'citizens_fname' => $request['edt_ct_fname'],
            'citizens_mname' => $request['edt_ct_mname'],
            'citizens_lname' => $request['edt_ct_lname'],
            'citizens_suffix' => $suffix,
            'citizens_bday' => $request['edt_ct_year']. '-'. $request['edt_ct_month'] . '-'. $request['edt_ct_day'],
            'citizens_gender' => $request['edt_ct_gender'],
            'citizens_profession' => $request['edt_ct_profession'],
            'citizens_mobile' => $request['edt_ct_mobile'],
            'province_id' => $request['edt_ct_perProv'],
            'province_id_current' => $request['edt_ct_curProv'],
            'municipalities_id' => $request['edt_ct_perMuni'],
            'municipalities_id_current' => $request['edt_ct_curMuni'],
            'barangays_id' => $request['edt_ct_perBrgy'],
            'barangays_id_current' => $request['edt_ct_curBrgy'],
            'zones_id' => $zoneSelected,
            'zones_id_current' => $zoneCurSelected,
            'citizen_add_address' => $request['edt_ct_perBldg'],
            'citizen_add_address_current' => $request['edt_ct_curBldg'],
        ]);

        return 'true';
    }
    public static function postBlockCitizen($request){
        Citizen::where('citizens_id', $request['selected_id'])->update(['verifications_id' => '3']);
        return true;
    }
    public static function postUnBlockCitizen($request){
        Citizen::where('citizens_id', $request['selected_id'])->update(['verifications_id' => '1']);
        return true;
    }
    public static function generateDownloadCitizen($request){
        $gender = 'all'; $verification ='all';
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

        session()->put('gender', $gender);
        session()->put('verification', $verification);

        session()->put('per_province', $per_province);
        session()->put('per_municipality', $per_municipality);
        session()->put('per_barangay', $per_barangay);
        session()->put('per_zone', $per_zone);

        session()->put('cur_province', $cur_province);
        session()->put('cur_municipality', $cur_municipality);
        session()->put('cur_barangay', $cur_barangay);
        session()->put('cur_zone', $cur_zone);

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

            return $data;
            
        }else{
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

            return $data;
        }
    }
    public static function downloadFilterCitizen(){
        date_default_timezone_set('Asia/Manila');
        $gender = session()->get('gender');
        $verification = session()->get('verification');

        $per_province = session()->get('per_province');
        $per_municipality = session()->get('per_municipality');
        $per_barangay = session()->get('per_barangay');
        $per_zone = session()->get('per_zone');
        $cur_province = session()->get('cur_province');
        $cur_municipality = session()->get('cur_municipality');
        $cur_barangay = session()->get('cur_barangay');
        $cur_zone = session()->get('cur_zone');

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

            return $data;
            
        }else{
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
            return $data;
        }
    }
    public static function downloadNoFilterCitizen(){
        $data = Citizen::with([
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
        return $data;
    }

    //-- common icard (start)
    public static function checkNumberICard($request){
        $rd = rand(100000,999999);
        $number = $request->d_number;
        $citizen = Citizen::where('citizens_mobile', $number)->first();
        
        if($citizen != null){
            Citizen::sendVerificationICard($number, $rd, '[download]');
            session()->put('id_code', $rd);
            session()->put('id_d_number', '+639XXXXXX' . substr($number, -3));
            session()->put('id_p_number', $number);
            return "true";
        }else{
            return 'false';
        }
    }
    public static function sendVerificationICard($number,$code,$reason){
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
        CURLOPT_POSTFIELDS => array('message' => 'LIBCT Tracing App - '. $reason.' Verification code - ' .$code,'number' => $number),
        CURLOPT_HTTPHEADER => array(
            "X-TXTBOX-Auth: bd6634972540039fbed3e55cccf351a6"
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        return true;
    }
    public static function checkCodeICard($request){
        $input_code = $request->id_code;
        $citizen_code = session('id_code');
        if($input_code == $citizen_code){
            return 'true';
        }else{
            return 'false';
        }
    }
    public static function resendVerificationICard(){
        $code = session('id_code');
        $number = session('id_p_number');
        Citizen::sendVerificationICard($number, $code, '[download]');
        return 'true';
    }
    public static function generateCitizenICard(){
        $number = session('id_p_number');
        $data =  Citizen::where('citizens_mobile',$number)
        ->with(['CitizenToProvince',
            'CitizenToMunicipality', 
            'CitizenToBarangay',
            'CitizenToZone',
            'CitizenToVerify',
            'getMainProvince',
            'getMainMunicipality',
            'getMainBarangay',
            'getMainZone'
        ])
        ->first();
        return $data;
    }
    //-- common icard (end)

    //-- common tracking (start)
    public static function checkNumberTracking($request){
        $rd = rand(100000,999999);
        $number = $request->number;
        $citizen = Citizen::where('citizens_mobile', $number)->first();
        
        if($citizen != null){
            session()->put('tracking_code', $rd);
            session()->put('tracking_d_number', '+639XXXXXX' . substr($number, -3));
            session()->put('tracking_p_number', $number);
            Citizen::sendVerificationICard($number, $rd , '[tracking]');
            return 'true';
        }else{
            return 'false';
        }
    }
    public static function checkCodeTracking($request){
        $input_code = $request->id_code;
        $citizen_code = session('tracking_code');
        if($input_code == $citizen_code){
            return 'true';
        }else{
            return 'false';
        }
    }
    public static function resendVerificationTracking(){
        $code = session('tracking_code');
        $number = session('tracking_p_number');
        Citizen::sendVerificationICard($number, $code, '[tracking]');
        return 'true';
    }
    public static function generateCitizenTracking(){
        $number = session('tracking_p_number');
        $data =  Citizen::where('citizens_mobile',$number)
        ->with(['CitizenToProvince',
            'CitizenToMunicipality', 
            'CitizenToBarangay',
            'CitizenToZone',
            'CitizenToVerify',
            'getMainProvince',
            'getMainMunicipality',
            'getMainBarangay',
            'getMainZone'
        ])
        ->first();
        return $data;
    }


    //-- common tracking (end)
}
