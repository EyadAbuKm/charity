<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User; // Import User model
use Illuminate\Support\Facades\Hash;

class RoleSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define roles
        $roles = ['Admin', 'Manager', 'Agent'];

        // Create roles if they don't already exist
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // Define permissions
        $permissions = [
            'donation',
            'families',
            'visits',
            'aid',
            'create',
            'delete',
            'update',
            'create_donation'
        ];

        // Create permissions if they don't already exist
        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        // Assign all permissions to Admin
        $adminRole = Role::findByName('Admin');
        $adminRole->syncPermissions(Permission::all());

        // Assign specific permissions to Manager
        $managerRole = Role::findByName('Manager');
        $managerRole->syncPermissions([
            'families',
            'visits',
            'aid',
        ]);

        // Assign specific permissions to Agent
        $agentRole = Role::findByName('Agent');
        $agentRole->syncPermissions([
            'visits',
            'aid',
        ]);

        // Create an Admin user if one doesn't exist
        $adminUser = User::firstOrCreate(
            ['user' => 'eyad'], // Ensure email is unique
            [
                'name' => 'eyad',
                'password' => Hash::make('password123'), // You should use a secure password
            ]
        );

        // Assign the Admin role to the user
        $adminUser->assignRole('Admin');

        // Output a success message
        $this->command->info('Roles, permissions, and admin user seeded successfully!');
    }
}
