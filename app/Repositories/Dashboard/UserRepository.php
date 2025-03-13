<?php

namespace App\Repositories\Dashboard;

use App\Models\User;

class UserRepository
{
    public function getUser($id){
        $user = User::find($id);
        return $user;
    }
    
    public function getAll(){
       return $users = User::get();
       
    }

    public function storeUser($data){
        $user = User::create($data);
        return $user;
    }

    public function destroy($user){
        return $user->delete();
    }

    public function changeStatus($user , $status){
       return  $user->update([
        'is_active' => $status,
       ]);
    }
}
