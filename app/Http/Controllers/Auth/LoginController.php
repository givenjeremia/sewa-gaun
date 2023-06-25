<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo ='/';
    // protected function redirectTo()
    // {
    //     $role = Auth::user()->roles;
    //     $link = '';
    //     if($role == 1){
    //        $this->redirectTo = '/admin/gaun';
    //     }
    //     if($role == 2){
    //         $this->redirectTo =  '/admin/perias';
    //     }

    //     if($role == 3){
    //         $this->redirectTo =  '/';
    //     }
    //     // dd($link);
    //     // return $link;
        
        
    //     // else{
    //     //     return '/'; 
    //     // }
        
    // }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
