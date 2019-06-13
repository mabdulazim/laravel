<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::updateOrCreate(['name' => 'CREATE_USERS']);
        Permission::updateOrCreate(['name' => 'READ_USERS']);
        Permission::updateOrCreate(['name' => 'UPDATE_USERS']);
        Permission::updateOrCreate(['name' => 'DELETE_USERS']);

        Permission::updateOrCreate(['name' => 'CREATE_ADMINS']);
        Permission::updateOrCreate(['name' => 'READ_ADMINS']);
        Permission::updateOrCreate(['name' => 'UPDATE_ADMINS']);
        Permission::updateOrCreate(['name' => 'DELETE_ADMINS']);

        $permissions = Permission::pluck('name')->toArray();

        $user = User::updateOrCreate([
            'email'    => 'mabdul3azim@gmail.com',            
        ],
        [
            'name'     => 'Admin',
            'email'    => 'mabdul3azim@gmail.com',
            'type'     => 'ADMIN',
            'password' => '123456',
        ]);

        $user->syncPermissions($permissions);
    }
}