<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UserController extends Controller
{
    

    //---- establishment registration form
    // public function getEstablishment(){
    //     return view ('establishment.establishmentRegistration');
    // }
    // public function getEstablishmentAdmin(){
    //     return view ('establishment.establishmentAdmin');
    // }
    // public function getEstablishmentVerification(){
    //     return view ('establishment.establishmentVerification');
    // }
    // public function getEstablishmentSummary(){
    //     return view ('establishment.establishmentSummary');
    // }

    //----- tracking 
    public function getMapTrack(){
        return view ('tracking.tracking_map');
    }

    public function getCitizenTrack(){
        return view ('tracking.tracking_citizen');
    }
    public function getCitizenTrackAuth(){
        return view ('tracking.tracking_citizen_auth');
    }
    public function getCitizenTrackCheckIn(){
        return view ('tracking.tracking_citizen_check_in');
    }


    


    




}

