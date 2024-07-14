<?php

namespace App\Http\Controllers;

use App\Dictionaries\EmployeePerformanceDictionary;
use Illuminate\Http\Request;

class EmployeePerformance extends Controller
{
    public function index(Request $request)
    {
        $work_result = $request->work_result ?? '';
        $behavior = $request->behavior ?? '';
        $result = '';

        if ($work_result && $behavior) {
            $result = EmployeePerformanceDictionary::calculateScore($work_result, $behavior);
        }

        return view('employee-performance.form', compact('work_result', 'behavior', 'result'));
    }
}
