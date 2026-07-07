<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'view dashboard',
            'create anggota',
            'edit anggota',
            'delete anggota',
            'view anggota',
            'export anggota',
            'import anggota',
            'manage kartu',
            'manage layout',
            'manage users',
            'manage settings',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $superAdmin = Role::create(['name' => 'super_admin']);
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'view dashboard',
            'create anggota',
            'edit anggota',
            'delete anggota',
            'view anggota',
            'export anggota',
            'import anggota',
            'manage kartu',
            'manage layout',
        ]);

        $anggota = Role::create(['name' => 'anggota']);
        $anggota->givePermissionTo([
            'view dashboard',
        ]);

        // Create default users
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@organisasi.com',
            'password' => bcrypt('password123'),
            'email_verified_at' => now(),
        ]);
        $user->assignRole('super_admin');

        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@organisasi.com',
            'password' => bcrypt('password123'),
            'email_verified_at' => now(),
        ]);
        $adminUser->assignRole('admin');

        $anggotaUser = User::create([
            'name' => 'Anggota Demo',
            'email' => 'anggota@organisasi.com',
            'password' => bcrypt('password123'),
            'email_verified_at' => now(),
        ]);
        $anggotaUser->assignRole('anggota');
    }
}