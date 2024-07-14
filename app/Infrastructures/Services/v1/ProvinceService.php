<?php

namespace App\Infrastructures\Services\v1;

use Illuminate\Support\Collection;
use App\Infrastructures\Repositories\ProvinceRepository;

class ProvinceService
{
    protected $provinceRepository;

    public function __construct()
    {
        $this->provinceRepository = new ProvinceRepository();
    }

    public function getAll()
    {
        return $this->provinceRepository->all();
    }

    public function findById($dailyLog, $with = [])
    {
        return $this->provinceRepository->findById($dailyLog, $with);
    }

    public function create($request)
    {
        // Create collection
        $collection = new Collection($request);

        // Create daily log
        $dataArray = ['name'];
        $data = $collection->only($dataArray)->toArray();
        $newUser = $this->provinceRepository->create($data);

        return $newUser;
    }

    public function update($provinceID, $request)
    {
        // Remove null data
        $request = arrayFilterNullData($request);

        // Create collection
        $collection = new Collection($request);

        // Update user
        $dataArray = ['name'];
        $data = $collection->only($dataArray)->toArray();
        $updatedProvince = $this->provinceRepository->updateById($provinceID, $data);

        return $updatedProvince;
    }

    public function delete($provinceID)
    {
        $this->provinceRepository->deleteById($provinceID);
    }
}
