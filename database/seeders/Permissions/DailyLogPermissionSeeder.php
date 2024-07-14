<?php

namespace Database\Seeders\Permissions;

use Database\Seeders\PermissionBaseSeeder;

class DailyLogPermissionSeeder extends PermissionBaseSeeder
{
    protected $roles = [
        self::SUPER_ADMIN,
        self::DEPARTMENT_HEAD,
        self::DIVISION_HEAD,
        self::STAFF,
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $generalPermission = [
            [ 'name' => 'daily-log', 'title' => 'Daily Log', 'is_parent' => true ],
            [ 'name' => 'daily-log-add', 'title' => 'Daily Log Add' ],
            [ 'name' => 'daily-log-list', 'title' => 'Daily Log List' ],
            [ 'name' => 'daily-log-update', 'title' => 'Daily Log Update' ],
        ];

        $permissions[self::SUPER_ADMIN] = [...$generalPermission,
            [ 'name' => 'daily-log-accept', 'title' => 'Daily Log Accept Daily Log' ],
            [ 'name' => 'daily-log-reject', 'title' => 'Daily Log Reject Daily Log' ],
            [ 'name' => 'daily-log-accept-division_head', 'title' => 'Daily Log Accept Division Head Daily Log' ],
            [ 'name' => 'daily-log-reject-division_head', 'title' => 'Daily Log Reject Division Head Daily Log' ],
            [ 'name' => 'daily-log-accept-staff', 'title' => 'Daily Log Accept Staff Daily Log' ],
            [ 'name' => 'daily-log-reject-staff', 'title' => 'Daily Log Reject Staff Daily Log' ],
        ];

        $permissions[self::DEPARTMENT_HEAD] = [...$generalPermission,
            [ 'name' => 'daily-log-accept', 'title' => 'Daily Log Accept Daily Log' ],
            [ 'name' => 'daily-log-reject', 'title' => 'Daily Log Reject Daily Log' ],
            [ 'name' => 'daily-log-accept-division_head', 'title' => 'Daily Log Accept Devision Head Daily Log' ],
            [ 'name' => 'daily-log-reject-division_head', 'title' => 'Daily Log Reject Devision Head Daily Log' ],
        ];

        $permissions[self::DIVISION_HEAD] = [...$generalPermission,
            [ 'name' => 'daily-log-accept', 'title' => 'Daily Log Accept Daily Log' ],
            [ 'name' => 'daily-log-reject', 'title' => 'Daily Log Reject Daily Log' ],
            [ 'name' => 'daily-log-accept-staff', 'title' => 'Daily Log Accept Staff Daily Log' ],
            [ 'name' => 'daily-log-reject-staff', 'title' => 'Daily Log Reject Staff Daily Log' ],
        ];

        $permissions[self::STAFF] = [...$generalPermission, ];

        $this->createPermission($this->roles, $permissions);
    }
}
