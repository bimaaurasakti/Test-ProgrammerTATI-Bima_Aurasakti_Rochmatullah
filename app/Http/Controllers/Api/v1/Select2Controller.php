<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Type;

class Select2Controller extends ApiController
{
    public function getSuppliers(Request $request)
    {
        $query = Supplier::query()->select('id', 'name as text');

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

    public function getTypes(Request $request)
    {
        $query = Type::query()->select('id', 'name as text');

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
}
