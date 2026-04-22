<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
          // Reset cache permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /**
         * ==========================
         * DEFINE PERMISSIONS
         * ==========================
         */
        $permissionGroups = [
            'user' => ['view', 'create', 'edit', 'delete'],
            'post' => ['view', 'create', 'edit', 'delete'],
        ];

        $allPermissions = [];

        foreach ($permissionGroups as $group => $actions) {
            foreach ($actions as $action) {
                $permission = Permission::firstOrCreate([
                    'name' => "{$group}.{$action}",
                ]);

                $allPermissions[] = $permission->name;
            }
        }

        /**
         * ==========================
         * DEFINE ROLES
         * ==========================
         */
        $roles = [
            'super-admin',
            'user',
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        $superAdmin = Role::where('name', 'super-admin')->first();
        $user = Role::where('name', 'user')->first();

        /**
         * ==========================
         * ASSIGN PERMISSIONS TO ROLES
         * ==========================
         */

        // Super Admin → semua permission
        $superAdmin->syncPermissions($allPermissions);

        // User → permission terbatas
        $user->syncPermissions([
            'post.view',
            'post.create',
        ]);
    }
}
