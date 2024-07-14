<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Infrastructures\Services\DynamicFormService;

class DynamicFormController extends Controller
{
    protected $dynamicForm;

    public function __construct()
    {
        $this->dynamicForm = new DynamicFormService();
    }

    public function index(Request $request)
    {
        $dynamicForms = $this->dynamicForm->getAll();
        return view('dynamic-form.form', compact('dynamicForms'));
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->dynamicForm->update($request->all());
            DB::commit();
            return redirect()->route('dynamic-form.index')->withSuccess('Dynamic form updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
