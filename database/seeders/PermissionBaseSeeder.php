<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Database\Seeders\Permissions\UserPermissionSeeder;
use Database\Seeders\Permissions\ProductPermissionSeeder;
use Database\Seeders\Permissions\ProductCategoryPermissionSeeder;

class PermissionBaseSeeder extends Seeder
{
    public const SUPER_ADMIN = 'super_admin';
    public const DEPARTMENT_HEAD = 'department_head';
    public const DIVISION_HEAD = 'division_head';
    public const STAFF = 'staff';

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        // Order is very crucial here
        $this->call([
            UserPermissionSeeder::class,
        ]);
    }

    public function createPermission($roles, $permissions)
    {
        foreach ($roles as $roleName) {
            $role = Role::where('name', $roleName)->first();
            $parent_id = null;
            foreach ($permissions[$roleName] as $permissionData) {
                $permission = Permission::where('name', $permissionData['name'])->first();
                $permissionData['parent_id'] = $parent_id;
                if (!$permission) {
                    $permission = Permission::create([
                        'name' => $permissionData['name'],
                        'title' => $permissionData['title'],
                        'parent_id' => $permissionData['parent_id'],
                    ]);
                }
                if(isset($permissionData['is_parent']) && $permissionData['is_parent']) {
                    $parent_id = $permission->id;
                }
                $role->givePermissionTo($permission);
            }
        }
    }
}
