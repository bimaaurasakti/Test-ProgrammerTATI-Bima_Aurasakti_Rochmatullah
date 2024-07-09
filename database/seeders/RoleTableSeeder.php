<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'super_admin',
                'title' => 'Super Admin',
                'status' => 1,
                'permissions' => []
            ],
            [
                'name' => 'department_head',
                'title' => 'Department Head',
                'status' => 1,
                'permissions' => []
            ],
            [
                'name' => 'division_head',
                'title' => 'Division Head',
                'status' => 1,
                'permissions' => []
            ],
            [
                'name' => 'staff',
                'title' => 'Staff',
                'status' => 1,
                'permissions' => []
            ],
        ];

        foreach ($roles as $key => $value) {
            $permission = $value['permissions'];
            unset($value['permissions']);
            $role = Role::create($value);
            $role->givePermissionTo($permission);
        }
    }
}
