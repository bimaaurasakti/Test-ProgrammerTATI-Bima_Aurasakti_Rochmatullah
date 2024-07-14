<?php

namespace App\Infrastructures\Repositories;

use App\Infrastructures\Core\Repository;
use App\Models\DynamicForm;

class DynamicFormRepository extends Repository
{
    protected function model(): string
    {
        return DynamicForm::class;
    }

    public function getAll()
    {
        return $this->model->orderBy('created_at', 'asc')->get();
    }
}
