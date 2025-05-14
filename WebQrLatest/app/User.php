<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'users';

    public $primaryKey = 'users_id';

    protected $fillable = [
        'users_fname', 
        'users_mname',
        'users_lname',
        'users_suffix',
        'users_gender',
        'users_bday',
        'users_mobile',
        'users_email',
        'users_username',
        'users_password',
        'users_profile',
        'types_id',
        'establishments_id',
    ];

    public $timestamps = false;

    protected $hidden = [
        'users_password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier(){
        return $this->getKey();
    }
    public function getJWTCustomClaims(){
        return [];
    }

    public function type(){
        return $this->belongsTo(Type::class, 'types_id', 'types_id');
    }
    public function getCompany(){
        return $this->hasOne('App\Establishment','establishments_id','establishments_id');
    }
    public function getAuthPassword(){
        return $this->attributes['users_password'];
    }
    public static function AddNewEstablishment($request, $findES, $suffix){
        $newUser = 
        [
            'users_fname' => $request['es_fname'],
            'users_mname' => $request['es_mname'],
            'users_lname' => $request['es_lname'],
            'users_suffix' => $suffix,
            'users_gender' => $request['es_gender'],
            'users_bday' => $request['es_year']. '-'. $request['es_month'] . '-'. $request['es_day'],
            'users_mobile' => $request['es_number'],
            'users_username' => null,
            'users_password' => null,
            'users_profile'=> null,
            'types_id' => 4,
            'establishments_id' => $findES->establishments_id
        ];
        User::create($newUser);
        return 'true';
    }
    public static function UpdateUserES($request){
        $suffix = $request->es_suffix;
        if($suffix == '0'){
            $suffix = null;
        }

        $esUser = User::where([
            ['users_id' , $request['esUser_id']],
            ['establishments_id' , $request['es_id']]
        ])->update([
            'users_fname' => $request['es_fname'],
            'users_mname' => $request['es_mname'],
            'users_lname' => $request['es_lname'],
            'users_suffix' => $suffix,
            'users_gender' => $request['es_gender'],
            'users_bday' => $request['es_year']. '-'. $request['es_month'] . '-'. $request['es_day'],
            'users_mobile' => $request['es_number'],
        ]);
        return true;
    }
    public static function CheckUsernameAdmin($request){
        $user = User::where('users_username', $request['user'])
        ->whereNotNull('users_username')
        ->first();
        if($user != null){
            return 'has';
        }else{
            return 'false';
        }   
    }
    public static function CheckNumberAdmin($request){
        $user = User::where('users_mobile', $request->numberValue)
        ->whereNotNull('users_username')
        ->first();
        if($user != null){
            return 'has';
        }else{
            return 'false';
        }  
    }
    public static function CheckExistAdmin($request){
        $suffix = $request->u_suffix;
        if($suffix  == '0'){
            $suffix = null;
        }
        $user = User::where('users_fname', $request['u_fname'])
        ->where('users_mname', $request['u_mname'])
        ->where('users_lname', $request['u_lname'])
        ->where('users_suffix', $suffix)
        ->where('users_gender', $request['u_gender'])
        ->where('users_bday', $request['u_year']. '-'. $request['u_month'] . '-'. $request['u_day'])
        // ->where('types_id', $request['u_type'])
        ->whereNotNull('users_username')
        ->first();

        if($user != null){
            return true;
        }else{
            return false;
        }
    }
    public static function AdminAddNew($request){
        $suffix = $request->u_suffix;
        if($suffix  == '0'){
            $suffix = null;
        }
        $newUser = 
        [
            'users_fname' => $request['u_fname'],
            'users_mname' => $request['u_mname'],
            'users_lname' => $request['u_lname'],
            'users_suffix' => $suffix,
            'users_gender' => $request['u_gender'],
            'users_bday' => $request['u_year']. '-'. $request['u_month'] . '-'. $request['u_day'],
            'users_mobile' => $request['u_number'],
            'users_username' => $request['u_username'],
            'users_password' => Hash::make($request['u_password']),
            'users_profile'=> "noprofile.png",
            'types_id' => $request['u_type']
        ];
        User::create($newUser);
    }
    public static function AccountGetAC($request){
        $user = User::where('users_id',$request->select_id)->with([
            'getCompany'
        ])->first();
        return $user;
    }
    public static function AccountCheckExistUpdate($request){
        $suffix = $request->u_suffix;
        if($suffix  == '0'){
            $suffix = null;
        }

        $user = User::where('users_fname', $request['u_fname'])
        ->where('users_mname', $request['u_mname'])
        ->where('users_lname', $request['u_lname'])
        ->where('users_suffix', $suffix)
        ->where('users_gender', $request['u_gender'])
        ->where('users_bday', $request['u_year']. '-'. $request['u_month'] . '-'. $request['u_day'])
        ->where('types_id', $request['u_type'])
        ->whereNotNull('users_username')
        ->first();

        if($user != null){
            if($user->users_id != $request['users_id']){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public static function AccountUpdate($request){
        $suffix = $request->u_suffix;
        if($suffix == '0'){
            $suffix = null;
        }

        $user = User::where([
            ['users_id' , $request['users_id']],
        ])->update([
            'users_fname' => $request['u_fname'],
            'users_mname' => $request['u_mname'],
            'users_lname' => $request['u_lname'],
            'users_suffix' => $suffix,
            'users_gender' => $request['u_gender'],
            'users_bday' => $request['u_year']. '-'. $request['u_month'] . '-'. $request['u_day'],
            'users_mobile' => $request['u_number'],
            'users_username' => $request['u_username'],
            'types_id' => $request['u_type'],
        ]);

        return true;
    }


    




}



