<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo(){
        $type = Auth::user()->types_id;
        switch($type){
            case 1: case 2: case 3:
                return '/dashboard';
            break;
            case 4:
                session()->flash('loginError', 'These credentials do not match our records.');
                Auth::logout();
                return '/login'; 
            break;
        }
    }

    public function username(){
        return 'users_username';
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }

    





}

