<?php

namespace Database\Seeders\Permissions;

use Database\Seeders\PermissionBaseSeeder;

class UserPermissionSeeder extends PermissionBaseSeeder
{
    protected $roles = [
        self::SUPER_ADMIN,
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $generalPermission = [
            [ 'name' => 'user', 'title' => 'User', 'is_parent' => true ],
            [ 'name' => 'user-add', 'title' => 'User Add' ],
            [ 'name' => 'user-list', 'title' => 'User List' ],
            [ 'name' => 'user-update', 'title' => 'User Update' ],
            [ 'name' => 'user-activate', 'title' => 'User Activate' ],
            [ 'name' => 'user-deactivate', 'title' => 'User Deactivate' ],
            [ 'name' => 'user-update-role', 'title' => 'User Update Role' ],
        ];

        $permissions[self::SUPER_ADMIN] = [...$generalPermission, ];

        $this->createPermission($this->roles, $permissions);
    }
}
