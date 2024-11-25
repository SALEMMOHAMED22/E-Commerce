<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPasswordRequest;
use App\Models\Admin;
use App\Notifications\SendOtpNotify;
use App\Services\Auth\PasswordService;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    protected $passwordService;
    protected $otp2;
    public function __construct(PasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
        $this->otp2 = new Otp;
    }
    public function showEmailForm(){
        return view('dashboard.auth.password.email');
    }


    public function sendOtp(ForgetPasswordRequest $request){

       
        $admin = $this->passwordService->getAdminByEmail($request->email);
        if(! $admin){
            return redirect()->back()->withErrors(['email'=>__('passwords.email_is_not_registerd')]);
        }

      
        return redirect()->route('dashboard.password.verify' , ['email'=>$admin->email]);
        
    }


    public function showOtpForm($email){
        return view('dashboard.auth.password.confirm',['email'=>$email]);
    }

    public function verifyOtp(ForgetPasswordRequest $request){

       $otp = $this->passwordService->verifyOtp($request->email , $request->code);
       
        if(!$otp){
            return redirect()->back()->withErrors(['error'=> __('passwords.code_is_not_valid')]);
        }

        return redirect()->route('dashboard.password.reset' , ['email'=>$request->email]);

 
    }
}
