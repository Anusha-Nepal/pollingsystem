<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use App\Models\Poll;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalPolls = Poll::count();
        $users = User::all(); 
        $roles = Roles::all(); 
        $permissions= Permission::all();
        $polls = Poll::with('votes.user')->paginate(10);
        
        return view('admin.dashboard', compact('totalUsers', 'totalPolls', 'users', 'roles','permissions', 'polls'));
    }
    public function assignRoles(Request $request)
    {
        
        $roles=Roles::all();
        $permissions=Permission::all();
        $users=User::all();
        if ($request->isMethod('post')) {
            $request->validate([
                'user_id' => 'required|exists:users,id', 
                'role_id' => 'required|exists:roles,id', 
            ]);
    

            $user = User::findOrFail($request->input('user_id'));
            $role = Roles::findOrFail($request->input('role_id'));
  
            $user->roles()->sync($role);
            return redirect()->back()->with('success', 'Role assigned successfully');
        }
    
        return view('admin.users_roles',['roles'=>$roles,'permissions'=>$permissions,'users'=>$users]);
    }
    
    public function assignPermission(Request $request)
    {
       $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|exists:permissions,id',
        ]);

       
         $role = Roles::find($request->input('role_id'));
        $role->permissions()->sync([$request->input('permission_id')]);
        return view('admin.roles_permissions');
    
    }
    public function viewAssignPermission(Request $request)
{
    dd('hello');
    $roles = Roles::all();
    $permissions = Permission::all();
 

    if ($request->isMethod('post')) {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|exists:permissions,id',
        ]);

        $permission = Permission::findOrFail($request->input('permission_id'));
        $role = Roles::findOrFail($request->input('role_id'));
        

        $role->permissions()->sync($permission);

        return redirect()->back()->with('success', 'permission assigned successfully');
    }

    return view('admin.users_roles', ['roles' => $roles, 'permissions' => $permissions]);
}

    public function viewRoles()
    {
    
        $roles = Roles::all();

        return view('admin.view_roles', compact('roles'));
    }

    public function createRole(Request $request)
    {
    
        $data=$request->validate([
            'role_name' => 'required|unique:roles,name',
        ]);
        

        Roles::create(['name' => $data['role_name']]);

        return redirect()->route('admin.view_roles')->with('success', 'Role created successfully.');
    }

   public function viewPermissions()
{
    $permissions = Permission::all();
    return view('admin.view_permissions', compact('permissions'));
}


   
    public function logout()
    {
        Auth::logout(); 
        return redirect('/login');

}
}