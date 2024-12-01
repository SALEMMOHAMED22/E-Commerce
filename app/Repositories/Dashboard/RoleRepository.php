<?php

namespace App\Repositories\Dashboard;

use App\Models\Role;

class RoleRepository
{
    public function getRole($id)
    {
        $role = Role::find($id);
        return $role;
    }

    public function createRole($request)
    {

        $role = Role::create([
            'role' => [
                'ar' => $request->role['ar'],
                'en' => $request->role['en'],
            ],

            'permission' => json_encode($request->permissions),
        ]);

        return $role;
    }
    public function  getRoles()
    {

        $roles = Role::select('id', 'role', 'permission')->paginate(6);
        return $roles;
    }

    public function updateRole($request, $role)
    {

        $role = $role->update([
            'role' => $request->role,
            'permission' =>json_encode($request->permissions),
        ]);
        return $role;
    }

    public function destroy($role){ 
        return $role->delete();
    }
}
