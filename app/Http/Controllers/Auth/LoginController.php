<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
   

    use AuthenticatesUsers;

 
    protected $redirectTo = '/home';

  
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        return view('website.auth.login');
    }

    public function authenticated(Request $request, $user)
    {
        
        Session::flash('success' ,  __('website.logged_in_successfully'));
        return redirect()->route('website.profile');
    }

    public function loggedOut(Request $request){
        return redirect()->route('website.login.get');
    }

    // public function redirectTo()
    // {
        
    //     return route('website.profile'); 
    // }



    
}
