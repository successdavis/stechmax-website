<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class UserPermissionController extends Controller
{
    public function index() {
        $permissions = Permission::all();

        return $permissions;
    }

    public function show(User $user) {
         $permissions = $user->getAllPermissions();

         return $permissions;
    }

    public function store(Permission $permission, User $user) {

        $permissssion = $user->givePermissionTo($permission->name);

        return response('permission sync', 200);
    }

    public function delete(Permission $permission, User $user) {
        $permissssion = $user->revokePermissionTo($permission->name);

        return response('permission revoked', 200); 
    }
}
