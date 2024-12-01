<?php

namespace App\Services\Dashboard;

use App\Models\Role;
use App\Repositories\Dashboard\RoleRepository;

class RoleService
{
    /**
     * Create a new class instance.
     */
    protected $roleRepository;
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getRole($id)
    {
        $role =  $this->roleRepository->getRole($id);
        return $role;
    }

    public function createRole($request)
    {

        $role =  $this->roleRepository->createRole($request);
        return $role;
    }

    public function  getRoles()
    {

        $roles = $this->roleRepository->getRoles();
        return $roles;
    }

    public function updateRole($request, $id)
    {

        $role = $this->roleRepository->getRole($id);

        if (!$role) {
            return false;
        }

        return $this->roleRepository->updateRole($request, $role);
    }

    public function destroy($id){
        $role = $this->roleRepository->getRole($id);

        if($role->admins->count() > 0 || !$role){
            return false;
        }

        return $this->roleRepository->destroy($role);
    }
}
