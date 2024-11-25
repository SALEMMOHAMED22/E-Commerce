<?php

namespace App\Repositories\Auth;

use App\Models\Admin;
use Ichtrojan\Otp\Otp;

class PasswordRepository
{
    /**
     * Create a new class instance.
     */
    protected $otp;
    public function __construct()
    {
        $this->otp = new Otp;
    } 

    public function getAdminByEmail($email){
       return Admin::where('email' , $email)->first();
    }

    public function verifyOtp($email , $code){
      return  $this->otp->validate($email , $code);
    }

    public function resetPassword($email , $password){

     $admin =    self::getAdminByEmail($email);

        if(!$admin){
            return false;
        }

        return $admin->update([
            'password'=>bcrypt($password),
        ]);





    }
}
