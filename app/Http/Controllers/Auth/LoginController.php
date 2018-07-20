<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers; 
use App\Http\Requests\LoginRequest;
use Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email','password');
        
        if (Auth::attempt($credentials)) {
            if (Auth::user()->level=='member') {
                return redirect('/home/user');     
            }else {
                return redirect('/home/admin');
            }    
         } else {
             return redirect('/login');
         }
    }
 
    public function logout()
    {
       Auth::logout();
       return redirect('/login');
    }
}