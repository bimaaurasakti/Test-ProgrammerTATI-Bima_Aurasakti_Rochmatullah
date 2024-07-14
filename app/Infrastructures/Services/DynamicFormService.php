<?php

namespace App\Infrastructures\Services;

use App\Infrastructures\Repositories\DynamicFormRepository;

class DynamicFormService
{
    protected $dynamicFormRepository;

    public function __construct()
    {
        $this->dynamicFormRepository = new DynamicFormRepository();
    }

    public function getAll()
    {
        return $this->dynamicFormRepository->getAll();
    }

    public function update($request)
    {
        // Create data
        if (array_key_exists('new_name', $request)) {
            foreach($request['new_name'] as $index => $value) {
                $data = [];
                $data['name'] = $value;
                $data['phone_number'] = $request['new_phone_number'][$index];
                $data['address'] = $request['new_address'][$index];
                $this->dynamicFormRepository->create($data);
            }
        }

        // Update user
        if (array_key_exists('name', $request)) {
            foreach($request['name'] as $id => $value) {
                $data = [];
                $data['name'] = $value;
                $data['phone_number'] = $request['phone_number'][$id];
                $data['address'] = $request['address'][$id];
                $this->dynamicFormRepository->updateById($id, $data);
            }
        }

        // Delete user
        if (array_key_exists('deleted_id', $request)) {
            foreach($request['deleted_id'] as $id) {
                $this->dynamicFormRepository->deleteById($id);
            }
        }
    }
}
