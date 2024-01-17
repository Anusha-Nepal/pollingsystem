<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;
use RoleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    
     public function run()
     {
         
         $roles = ['admin', 'user'];
         $this->call([
            AdminSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
        ]);
 
         foreach ($roles as $role) {
             $newRole = Roles::create(['name' => $role]);
 
             if ($role === 'admin') {
                 $permissions = Permission::all();
                 $newRole->permissions()->attach($permissions);
             }
             
             
         }
     }
}
