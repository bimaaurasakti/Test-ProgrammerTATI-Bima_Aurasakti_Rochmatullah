<?php

namespace App\Infrastructures\Repositories;

use App\Infrastructures\Core\Repository;
use App\Models\Province;

class ProvinceRepository extends Repository
{
    protected function model(): string
    {
        return Province::class;
    }
}
