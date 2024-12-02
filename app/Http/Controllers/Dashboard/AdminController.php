<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Services\Dashboard\AdminService;
use App\Services\Dashboard\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
   protected $adminService , $roleService;
  
    public function __construct(AdminService $adminService , RoleService $roleService )
    {
        $this->adminService = $adminService;
        $this->roleService = $roleService;

    }
    public function index()
    {
        $admins = $this->adminService->getAdmins();
        return view('dashboard.admins.index' , ['admins'=>$admins]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = $this->roleService->getRoles();
        return view('dashboard.admins.create' , ['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $data = $request->only('name' , 'email' , 'password' , 'role_id' , 'status');
        $admin = $this->adminService->storeAdmin($data);
        if(!$admin){
            Session::flash('error' , 'Admin Not Found!');
            return redirect()->back();
        }
        Session::flash('success' ,'Admin Created Successfully');
        return redirect()->route('dashboard.admins.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = $this->adminService->getAdmin($id);
        if(!$admin){
            Session::flash('error' , 'Admin Not Found!');
            return redirect()->back();
        }
        return view('dashboard.admins.edit' , ['admin'=>$admin]);
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, string $id)
    {
        $data = $request->only('name' , 'email' , 'password' , 'role_id' , 'status');
        $admin = $this->adminService->updateAdmin($data , $id);
        if(!$admin){
            Session::flash('error' , 'Admin Not Found!');
            return redirect()->back();
        }
        Session::flash('success' ,'Admin Updated Successfully');
        return redirect()->route('dashboard.admins.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = $this->adminService->destroy($id);

         if(!$admin){
            Session::flash('error' , 'Admin Not Found!');
            return redirect()->back();
        }
        Session::flash('success' ,'Admin deleted Successfully');
        return redirect()->route('dashboard.admins.index');

    }
}
