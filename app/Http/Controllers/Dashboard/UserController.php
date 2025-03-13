<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\userRequest;
use App\services\Dashboard\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService ;
    }

    public function index(){
        return view('dashboard.users.index') ;
    }

    public function getAll(){

     return $this->userService->getUsersForDatatable();
       
    }
   
    public function create()
    {
        //
    }

    
    public function store(userRequest $request)
    {
        $data = $request->only('name' , 'email' , 'password' , 'city_id' , 'country_id' , 'governorate_id' , 'is_active');
        $user =  $this->userService->storeUser($data);

        if(!$user){
            return response()->json([
                'status' => 'error',
                'message' => __('dashboard.error_msg'),
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg') ,
        ] , 201);
    }
 
    
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

   
    public function destroy(string $id)
    {

        $user = $this->userService->destroy($id);

        if(!$user){
            return response()->json([
                'status' => 'error',
                'message' => __('dashboard.error_msg'),
            ] , 500);
        }

        
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg'),
        ] , 200);

    }

    public function changeStatus(Request $request){
        $user = $this->userService->changeStatus($request->id);

        if(!$user){
            return response()->json([
                'status' => 'error',
                'message' => __('dashboard.error_msg'),
            ] , 500);
        }

        
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg'),
        ] , 200);


    
    }

}
