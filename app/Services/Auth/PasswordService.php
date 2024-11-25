<?php

namespace App\Services\Auth;

use App\Notifications\SendOtpNotify;
use App\Repositories\Auth\PasswordRepository;

class PasswordService
{
    /**
     * Create a new class instance.
     */
    protected $passwordRepository;
    public function __construct(PasswordRepository $passwordRepository)
    {
        $this->passwordRepository= $passwordRepository;
    }


    public function getAdminByEmail($email){

      $admin =   $this->passwordRepository->getAdminByEmail($email);
      if(!$admin){
        return false;
      }
      $admin->notify(new SendOtpNotify);
      return $admin;
    }

    public function verifyOtp($email , $code){

     $otp =   $this->passwordRepository->verifyOtp($email,$code);
     return $otp->status;
    }

    public function resetPassword($email , $password){

       return $this->passwordRepository->resetPassword($email , $password);
    }
}
 