<?php

namespace Database\Seeders;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // AdminSeeder.php

public function run()
{
    // Create admin user
    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => Hash::make('admin_password'),
    ]);

     // Attach the 'admin' role to the admin user
     $adminRole = Roles::where('name', 'admin')->first();
     $admin->roles()->sync($adminRole->id);
}

}
