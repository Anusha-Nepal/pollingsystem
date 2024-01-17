<?php


namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $adminRole = Roles::create(['name' => 'admin']);
        $userRole = Roles::create(['name' => 'user']);

        $adminRole->permissions()->attach(Permission::pluck('id'));
        $userRole->permissions()->sync(Permission::whereIn('route_name', ['user.create', 'user.edit'])->pluck('id'));

        // Assign the 'admin' role to a specific user
        $adminUser = User::where('email', 'admin@example.com')->first();
        if ($adminUser) {
            $adminUser->roles()->sync([$adminRole->id]);
        }

        
    }

}