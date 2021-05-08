<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create admin permissions
        Permission::create(['name' => 'CRUD users']);
        Permission::create(['name' => 'CRUD businesses']);

        // create healthstaff permissions
        Permission::create(['name' => 'update users health status']);

        // create admin role
        $admin = Role::create(['name' => 'admin'])
            ->givePermissionTo(Permission::all());

        // create healthstaff role
        $healthstaff = Role::create(['name' => 'healthstaff']);
        $healthstaff->givePermissionTo('update users health status');
    }
}
