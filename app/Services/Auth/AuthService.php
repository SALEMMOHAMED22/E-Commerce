<?php

namespace App\Services\Auth;

use App\Repositories\Auth\AuthRepository;

class AuthService
{
    protected $authRepository;
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login($credintials, $gaurd, $remember)
    {

        return   $this->authRepository->login($credintials, $gaurd, $remember);
    }
    public function logout($gaurd){

     return   $this->authRepository->logout($gaurd);
    }
}
