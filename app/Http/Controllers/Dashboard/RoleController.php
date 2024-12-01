<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\roleRequest;
use App\Services\Dashboard\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
protected $roleService;
    public function __construct(RoleService $roleService)
    {
        $this->roleService= $roleService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = $this->roleService->getRoles();
        return view('dashboard.roles.index' , compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(roleRequest $request)
    {
    $role = $this->roleService->createRole($request);
    if(!$role){
        return redirect()->back()->withErrors( ['something went wrong']);
    }
    
    return redirect()->back()->with('success' , 'role created successfully');
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
    public function edit( $id)
    {
        $role = $this->roleService->getRole($id);
       
        if(!$role){
            return  redirect()->back()->with('error','something is wrong!');
        }
        return view('dashboard.roles.edit' , ['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(roleRequest $request, string $id)
    {
       $role =  $this->roleService->updateRole($request , $id);
        if(!$role){
            return  redirect()->back()->with('error','something is wrong!');
        }
        return redirect()->route('dashboard.roles.index')->with('success',' operation is successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = $this->roleService->destroy($id);
        if(!$role){
            return redirect()->back()->with('error'  , 'something is wrong');
        }
        return redirect()->back()->with('success' , 'successful operation');
    }
}
