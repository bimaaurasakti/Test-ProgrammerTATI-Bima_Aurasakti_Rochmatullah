<?php

namespace App\Infrastructures\Services;

use Illuminate\Support\Str;
use App\Infrastructures\Repositories\RoleRepository;

class RoleService
{
    protected $roleRepository;

    public function __construct()
    {
        $this->roleRepository = new RoleRepository();
    }

    public function getAllData()
    {
        return $this->roleRepository->all();
    }

    public function getDataWithoutSuperAdmin()
    {
        return $this->roleRepository->getDataWithoutSuperAdmin();
    }

    public function getDataByName($roleName)
    {
        return $this->roleRepository->getDataByName($roleName);
    }

    public function getById($id)
    {
        $role = $this->roleRepository->findById($id);

        return $role;
    }

    public function createRole($request)
    {
        $data = $request->all();
        $data['name'] = Str::slug($data['title'], '-');
        $data['title'] = ucwords($data['title']);

        $role = $this->roleRepository->create($data);

        return $role;
    }

    public function updateRole($id, $request)
    {
        $data = $request->all();
        $data['name'] = Str::slug($data['title'], '-');
        $data['title'] = ucwords($data['title']);

        $role = $this->roleRepository->updateById($id, $data);

        return $role;
    }

    public function deleteRole($id)
    {
        $role = $this->roleRepository->deleteById($id);

        return $role;
    }
}
