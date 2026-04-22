<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AddPermission extends Command
{
    protected $signature = 'permission:add 
                            {name : Nama permission} 
                            {--roles=* : Role yang diberi permission}';

    protected $description = 'Tambah permission dan assign ke role';

    public function handle()
    {
        $name = $this->argument('name');
        $roles = $this->option('roles');

        // Buat permission
        $permission = Permission::firstOrCreate([
            'name' => $name,
            'guard_name' => 'web',
        ]);

        // Assign ke role
        if (!empty($roles)) {
            foreach ($roles as $roleName) {
                $role = Role::where('name', $roleName)->first();

                if ($role) {
                    $role->givePermissionTo($permission);
                    $this->info("Permission diberikan ke role: {$roleName}");
                } else {
                    $this->warn("Role tidak ditemukan: {$roleName}");
                }
            }
        }

        // Reset cache permission
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $this->info("Permission '{$name}' berhasil ditambahkan.");
    }
}
