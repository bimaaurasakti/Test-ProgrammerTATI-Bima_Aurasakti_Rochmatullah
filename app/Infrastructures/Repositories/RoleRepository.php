<?php

namespace App\Infrastructures\Repositories;

use Spatie\Permission\Models\Role;
use App\Infrastructures\Core\Repository;

class RoleRepository extends Repository
{
    protected function model(): string
    {
        return Role::class;
    }

    public function getDataWithoutSuperAdmin()
    {
        return Role::whereNot('name', 'super_admin')->get();
    }

    public function getDataByName($roleName)
    {
        return Role::where('name', $roleName)->first();
    }

    public function whereInByName($roleNames)
    {
        return Role::whereIn('name', $roleNames)->get();
    }
}
