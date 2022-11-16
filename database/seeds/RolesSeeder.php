<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $role = Role::create([
        	'name' => 'webmaster',
        ]);

        $role->givePermissionTo('all_access');
        $role->givePermissionTo('admin_access');
        $role->givePermissionTo('analyst_access');
        $role->givePermissionTo('user_access');

        $role = Role::create([
        	'name' => 'admin',
        ]);

        $role->givePermissionTo('admin_access');
        $role->givePermissionTo('analyst_access');

        $role = Role::create([
            'name' => 'analyst',
        ]);

        $role->givePermissionTo('analyst_access');


        $role = Role::create([
        	'name' => 'customer',
        ]);

        $role->givePermissionTo('user_access');
    }
}