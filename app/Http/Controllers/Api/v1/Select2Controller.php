<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;
use App\Dictionaries\Users\UserTypeDictionary;

class Select2Controller extends ApiController
{
    public function getManagers(Request $request)
    {
        $query = DB::table('users')->selectRaw('id, CONCAT(first_name, " ", last_name) as text');

        // Query by manager type
        $managerType = UserTypeDictionary::getManagerRole($request->user_type);
        $query->where('user_type', $managerType);

        if($request->search) {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        $count_filtered = $query->count();
        $results = $query->offset(($request->page - 1) * 10)
                        ->limit($request->limit)
                        ->orderBy('created_at', 'desc')
                        ->get();

        return $this->select2SuccessResponse($count_filtered, $results);
    }

    public function getUsers(Request $request)
    {
        $query = DB::table('users')->selectRaw('id, CONCAT(first_name, " ", last_name) as text');

        if($request->search) {
            $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$request->search}%"])
                  ->orWhere('id', 'LIKE', "%{$request->search}%");
        }

        $count_filtered = $query->count();
        $results = $query->offset(($request->page - 1) * 10)
                        ->limit($request->limit)
                        ->orderBy('created_at', 'desc')
                        ->get();

        return $this->select2SuccessResponse($count_filtered, $results);
    }
}
