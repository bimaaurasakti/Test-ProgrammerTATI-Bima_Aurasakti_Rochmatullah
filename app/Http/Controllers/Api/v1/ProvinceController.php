<?php

namespace App\Http\Controllers\Api\V1;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;
use App\Infrastructures\Services\v1\ProvinceService;

class ProvinceController extends ApiController
{
    protected $provinceService;

    public function __construct()
    {
        $this->provinceService = new ProvinceService();
    }

    public function index(Request $request)
    {
        try {
            $provinces = $this->provinceService->getAll();
            return $this->successResponse($provinces);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function create(Request $request)
    {
        $this->create($request);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $province = $this->provinceService->create($request->all());
            DB::commit();
            return $this->successResponse($province);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }
    }

    public function show(Request $request, $id)
    {
        try {
            $province = $this->provinceService->findById($id);
            return $this->successResponse($province);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function edit(Request $request, $id)
    {
        $this->update($request, $id);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $province = $this->provinceService->update($id, $request->all());
            DB::commit();
            return $this->successResponse($province);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $this->provinceService->delete($id);
            DB::commit();
            return $this->successResponse([], 'Province deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }
    }
}
