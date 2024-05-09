<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create(
            [
                'name' => 'Homam Haidar',
                'email' => 'homamhaidar18@gmail.com',
                'address' => 'Syria',
                'password' => Hash::make('12345678'),
            ]);
        $role = Role::create(['name' => 'Admin']);
        $default = Role::create(['name' => 'default']);
        $permissions = ['add', 'edit', 'delete', 'show'];

        foreach ($permissions as $permission) {
            Permission::create(
                ['name' => $permission . ' order'],
            );
            Permission::create(
                ['name' => $permission . ' client'],
            );
            Permission::create(
                ['name' => $permission . ' company'],
            );
            Permission::create(
                ['name' => $permission . ' product'],
            );
            Permission::create(
                ['name' => $permission . ' journey'],
            );
            Permission::create(
                ['name' => $permission . ' user'],
            );

        }
        Permission::create(
            ['name' => 'add role']);

        Permission::create(
            ['name' => 'assign role']);
        Permission::create(
            ['name' => 'add task']
        );
        Permission::create(
            ['name' => 'assign task']
        );
        Permission::create(
            ['name' => 'show own order']
        );
        Permission::create(
            ['name' => 'delete own order']
        );
        Permission::create(
            ['name' => 'show own clients']
        );
        Permission::create(
            ['name' => 'show own company']
        );

        $permission = Permission::all();
        $role->givePermissionTo($permission);

        $defaultpermission = ['add order', 'add client', 'add company', 'add journey', 'add product', 'add task',
            'edit order', 'edit client', 'edit company', 'edit journey',
            'show own order', 'show own clients', 'show own company', 'show product', 'show journey',
            'delete own order', 'delete journey'];
        $default->givePermissionTo($defaultpermission);

        $user->assignRole('Admin');

    }
}
