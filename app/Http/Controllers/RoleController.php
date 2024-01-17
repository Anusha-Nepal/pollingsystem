<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;

use App\Models\Permission;

class RoleController extends Controller
{
    public function createRole(Request $request)
    {
        $role = Roles::create(['name' => $request->input('name')]);

        return response()->json($role, 201);
    }

    // Create a new permission
    public function createPermission(Request $request)
    {
        $permission = Permission::create(['name' => $request->input('name')]);

        return response()->json($permission, 201);
    }

    // Assign a permission to a role
    public function assignPermissionToRole(Request $request, $roleId, $permissionId)
    {
        $role = Roles::findOrFail($roleId);
        $permission = Permission::findOrFail($permissionId);

        $role->permissions()->attach($permission);

        return response()->json(['message' => 'Permission assigned to role'], 200);
    }

    
    public function getAllRoles()
    {
        $roles = Roles::all();

        return response()->json($roles, 200);
    }

    // Get all permissions
    public function getAllPermissions()
    {
        $permissions = Permission::all();

        return response()->json($permissions, 200);
    }

    // Get permissions for a specific role
    public function getPermissionsForRole($roleId)
    {
        $role = Roles::findOrFail($roleId);
        $permissions = $role->permissions;

        return response()->json($permissions, 200);
    }

    // Update role name
    public function updateRoleName(Request $request, $roleId)
    {
        $role = Roles::findOrFail($roleId);
        $role->update(['name' => $request->input('name')]);

        return response()->json($role, 200);
    }

    // Delete a role
    public function deleteRole($roleId)
    {
        $role = Roles::findOrFail($roleId);
        $role->delete();

        return response()->json(['message' => 'Role deleted'], 200);
    }

    // Revoke a permission from a role
    public function revokePermissionFromRole($roleId, $permissionId)
    {
        $role = Roles::findOrFail($roleId);
        $permission = Permission::findOrFail($permissionId);

        $role->permissions()->detach($permission);

        return response()->json(['message' => 'Permission revoked from role'], 200);
    }
}

