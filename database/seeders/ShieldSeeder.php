<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // === 1. CREATE PERMISSIONS ===
        $resources = [
            'Jurusan',
            'Guru',
            'Kategori',
            'Ekstrakurikuler',
            'Prestasi',
            'Galeri',
            'Artikel',
            'PesanKontak',
            'Pendaftar',
            'User',
            'Kelulusan',
        ];

        $actions = ['viewAny', 'view', 'create', 'update', 'delete', 'deleteAny', 'restore', 'forceDelete'];

        foreach ($resources as $resource) {
            foreach ($actions as $action) {
                Permission::create(['guard_name' => 'web', 'name' => "{$resource}::{$action}"]);
            }
        }

        // Reset cache again after creating permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $this->command->info('✅ ' . (count($resources) * count($actions)) . ' permissions created.');

        // === 2. CREATE super_admin ROLE (all permissions) ===
        $superAdmin = Role::create(['guard_name' => 'web', 'name' => 'super_admin']);

        $allPermissions = Permission::all()->pluck('name')->toArray();
        $superAdmin->givePermissionTo($allPermissions);
        $this->command->info('✅ super_admin role created with all permissions.');

        // === 3. CREATE admin_staff ROLE (limited permissions - view, create, update) ===
        $staffPermissionNames = [];
        foreach ($resources as $resource) {
            $staffPermissionNames[] = "{$resource}::viewAny";
            $staffPermissionNames[] = "{$resource}::view";
            $staffPermissionNames[] = "{$resource}::create";
            $staffPermissionNames[] = "{$resource}::update";
        }

        $adminStaff = Role::create(['guard_name' => 'web', 'name' => 'admin_staff']);
        $adminStaff->givePermissionTo($staffPermissionNames);
        $this->command->info('✅ admin_staff role created with view/create/update permissions.');

        // === 4. CREATE panel_user ROLE (basic access) ===
        Role::create(['guard_name' => 'web', 'name' => 'panel_user']);
        $this->command->info('✅ panel_user role created (basic access only).');

        // === 5. ASSIGN ADMIN USER TO super_admin ===
        $admin = User::where('email', 'admin@smkalhidayah.sch.id')->first();
        if ($admin) {
            $admin->assignRole('super_admin');
            $this->command->info('✅ Admin user assigned to super_admin role.');
        } else {
            $this->command->warn('⚠️  Admin user (admin@smkalhidayah.sch.id) not found.');
        }

        $this->command->info('🎉 Shield setup complete!');
    }
}
