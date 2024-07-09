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
}
