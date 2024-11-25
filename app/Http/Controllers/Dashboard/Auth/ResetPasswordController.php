<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\Admin;
use App\Services\Auth\PasswordService;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    protected $passwordService;
    public function __construct(PasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
    }
    public function showresetForm($email){
        return view('dashboard.auth.password.reset' ,['email'=>$email]);
    }

    public function resetPassword(ResetPasswordRequest $request){

      $admin =  $this->passwordService->resetPassword($request->email , $request->password);
     
        if(!$admin){
            return redirect()->back()->with(['error'=>'Try Again Later']);
        } 

     

        return redirect()->route('dashboard.login')->with(['success'=>'Your Password Update Successfully']);
    }
}
