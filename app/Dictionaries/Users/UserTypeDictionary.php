<?php

namespace App\Dictionaries\Users;

class UserTypeDictionary
{
    const USER_TYPE_SUPER_ADMIN = 'super_admin';
    const USER_TYPE_DEPARTMENT_HEAD = 'department_head';
    const USER_TYPE_DIVISION_HEAD = 'division_head';
    const USER_TYPE_STAFF = 'staff';

    const GROUP_USER_TYPE_ADMIN = [
        self::USER_TYPE_SUPER_ADMIN
    ];
    const GROUP_USER_TYPE_MANAGER = [
        self::USER_TYPE_DEPARTMENT_HEAD,
        self::USER_TYPE_DIVISION_HEAD,
    ];

    public static function getManagerRole($user_role) {
        switch ($user_role) {
            case self::USER_TYPE_DIVISION_HEAD:
                return self::USER_TYPE_DEPARTMENT_HEAD;
            case self::USER_TYPE_STAFF:
                return self::USER_TYPE_DIVISION_HEAD;
            default:
                return null;
        }
    }
}
