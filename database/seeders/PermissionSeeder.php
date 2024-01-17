<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['common_name' => 'Create', 'route_name' => 'users.create', 'group_name' => 'Users'],
            ['common_name' => 'Update', 'route_name' => 'users.update', 'group_name' => 'Users'],
            ['common_name' => 'Edit', 'route_name' => 'users.edit', 'group_name' => 'Users'],
            ['common_name' => 'Delete', 'route_name' => 'users.delete', 'group_name' => 'Users'],
            ['common_name' => 'Create Poll', 'route_name' => 'polls.create', 'group_name' => 'Polls'],
            ['common_name' => 'View Poll', 'route_name' => 'polls.view', 'group_name' => 'Polls'],
            ['common_name' => 'Vote', 'route_name' => 'polls.vote', 'group_name' => 'Polls'],
            ['common_name' => 'Close Poll', 'route_name' => 'polls.close', 'group_name' => 'Polls'],
            ['common_name' => 'Create Poll', 'route_name' => 'polls.create', 'group_name' => 'Polls'],
            ['common_name' => 'View Poll', 'route_name' => 'polls.view', 'group_name' => 'Polls'],
            ['common_name' => 'Vote', 'route_name' => 'polls.vote', 'group_name' => 'Polls'],
            ['common_name' => 'Close Poll', 'route_name' => 'polls.close', 'group_name' => 'Polls'],
            ['common_name' => 'Edit Poll', 'route_name' => 'polls.edit', 'group_name' => 'Polls'],
            ['common_name' => 'Delete Poll', 'route_name' => 'polls.delete', 'group_name' => 'Polls'],
            ['common_name' => 'Export Poll Results', 'route_name' => 'polls.export', 'group_name' => 'Polls'],
            ['common_name' => 'Share Poll', 'route_name' => 'polls.share', 'group_name' => 'Polls'],
            ['common_name' => 'View Voting Analytics', 'route_name' => 'polls.analytics', 'group_name' => 'Polls'],
            ['common_name' => 'Manage Participants', 'route_name' => 'polls.participants', 'group_name' => 'Polls'],
];
       

        foreach ($permissions as $permissionData) {
            Permission::create($permissionData);
        }
    }
}
