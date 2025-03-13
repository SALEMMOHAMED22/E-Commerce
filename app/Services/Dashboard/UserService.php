<?php

namespace App\services\Dashboard;

use App\Repositories\Dashboard\UserRepository;
use PhpParser\Node\Expr\FuncCall;
use Yajra\DataTables\DataTables;

class UserService
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsersForDatatable(){

        $users = $this->userRepository->getAll();
        return DataTables::of($users)
        ->addIndexColumn()
        ->addColumn('is_active' , function($user){
            return $user->getStatusTranslated();
        })
        ->addColumn('country' , function($user){
            return $user->country->name;
        })
        ->addColumn('governorate' , function($user){
            return $user->governorate->name ;
        })
        ->addColumn('city' , function($user){
            return $user->city->name ;
        })
        // ->addColumn('num_of_orders' , function($user){
        //     return $user->orders->count() > 0 ? $user->orders->count() : __('dashboard.no_orders_found');
        // })
        ->addColumn('action' , function($user){
            return view('dashboard.users.datatables.actions' , compact('user'));
        })
        ->make(true);
    }

    public function storeUser($data){
     $user = $this->userRepository->storeUser($data);
        if(!$user){
            return false;
        }
        return $user;
    }
    public function getUser($id){
        $user =  $this->userRepository->getUser($id);
        if(! $user){
            return false;
        }
        return $user;
    }

    public function destroy($id){
        $user = $this->getUser($id);
       
       $user = $this->userRepository->destroy($user);
       return $user;

    }
    public function changeStatus($id){
      $user =   $this->getUser($id);

      $user->is_active == 1 ? $status = 0 : $status = 1 ;

     return $this->userRepository->changeStatus($user , $status);


    }
}
