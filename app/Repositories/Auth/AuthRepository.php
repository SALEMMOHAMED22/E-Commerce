<?php

namespace App\Repositories\Auth;

use Illuminate\Support\Facades\Auth;

class AuthRepository
{
    public function login($credintials ,$gaurd , $remember=false){
       return Auth::guard($gaurd)->attempt($credintials ,$remember);
    }
    public function logout($gaurd){

        return    Auth::guard($gaurd)->logout();

    }
} 
