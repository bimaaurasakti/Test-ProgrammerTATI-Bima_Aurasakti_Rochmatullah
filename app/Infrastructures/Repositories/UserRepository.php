<?php

namespace App\Infrastructures\Repositories;

use App\Infrastructures\Core\Repository;
use App\Models\User;

class UserRepository extends Repository
{
    protected function model(): string
    {
        return User::class;
    }

    public function deactivate($userID)
    {
        return User::find($userID)->update([
            'is_active' => 0
        ]);
    }


    public function activate($userID)
    {
        return User::find($userID)->update([
            'is_active' => 1
        ]);
    }
}
