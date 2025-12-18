<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create roles
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleUser = Role::firstOrCreate(['name' => 'user']);

        // create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $admin->assignRole($roleAdmin);

        // create ahmad user
        $ahmad = User::firstOrCreate(
            ['email' => 'ahmad@example.com'],
            [
                'name' => 'Ahmad',
                'username' => 'ahmad',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $ahmad->assignRole($roleUser);
        // $ahmad->assignRole($roleAdmin); // Uncomment if you want Ahmad to be an admin (cannot create posts)
    }
}
