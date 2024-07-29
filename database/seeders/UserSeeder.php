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
        $permissions = ['index','add', 'edit', 'delete', 'show'];

        foreach ($permissions as $permission) {
            Permission::create(
                ['name' => $permission . ' deal'],
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
            Permission::create(
                ['name' => $permission . ' role'],
            );
            Permission::create(
                ['name' => $permission . ' task'],
            );
            Permission::create(
                ['name' => $permission . ' lead'],
            );

        }

        Permission::create(
            ['name' => 'assign task']
        );
 Permission::create(
            ['name' => 'lead to client']
        );
 Permission::create(
            ['name' => 'won lead']
        );
 Permission::create(
            ['name' => 'lose lead']
        );
 Permission::create(
            ['name' => 'restore lead']
        );
 Permission::create(
            ['name' => 'index archive']
        );
 Permission::create(
            ['name' => 'won deal']
        );
 Permission::create(
            ['name' => 'lose deal']
        );

        $permission = Permission::all();
        $role->givePermissionTo($permission);

        $defaultpermission =
            ['add deal', 'add client', 'add company', 'add journey', 'add product', 'add task', 'add lead',
                 'index deal', 'index client', 'index company', 'index journey', 'index product', 'index task', 'index lead',
                'edit deal', 'edit client', 'edit company', 'edit journey','edit task','edit lead',
                 'show product', 'show journey','show task','show lead',
                 'delete journey','delete task','delete lead','restore lead','index archive',
                'lead to client','won lead','lose lead','assign task',
                'won deal','lose deal'];
        $default->givePermissionTo($defaultpermission);

        $user->assignRole('Admin');

    }
}
