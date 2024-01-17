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
    
    // public function deleteUser($userId)
    // {
    //     $user = User::find($userId);
    
    //     if (!$user) {
    //         return redirect()->route('admin.dashboard')->with('error', 'User not found.');
    //     }
    
    //     $user->choices()->delete();
    
      
    //     $user->votes()->delete();
    
    
    //     $user->delete();
    
    //     return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
    // }
    
    
    public function assignRoles(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);


        $user = User::find($request->input('user_id'));
        $role = Roles::find($request->input('role_id'));

        $user->roles()->attach($role);

        return redirect()->back()->with('success', 'Role assigned successfully.');
    }
    public function assignPermission(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|exists:permissions,id',
        ]);
    
        $role = Roles::find($request->input('role_id'));
        $permission = Permission::find($request->input('permission_id'));
    
        // $role->permissions()->attach($permission);
    
        // return redirect()->back()->with('success', 'Permission assigned successfully.');
        if (!$role->permissions->contains($permission->id)) {
            $role->permissions()->attach($permission);
            return redirect()->route('admin.dashboard')->with('success', 'Permission assigned successfully.');
        } else {
            return redirect()->route('admin.dashboard')->with('error', 'Permission is already assigned to this role.');
        }
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


    // public function createPermission(Request $request)
    // {
      
    //     $data=$request->validate([
    //         'permission_name' => ['required','unique:permissions,route_name'],
          
    //     ]);
    //   $array= explode('.',$data['permission_name']);
    
    //     Permission::create([
    //         'route_name'=>$data['permission_name'],
    //         'common_name'=>$array[1],
    //         'group_name'=>$array[0],        
    //     ]);
   

    //     return redirect()->route('admin.view_permissions')->with('success', 'Permission created successfully.');
    // }
    
    public function logout()
    {
        Auth::logout(); 
        return redirect('/login');
//     }
}
}