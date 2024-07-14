<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloWorldController extends Controller
{
    public function helloworld(Request $request)
    {
        $n = $request->n ?? 1;
        $result = [];
        for($i = 1; $i <= $n; $i++) {
            $output = [];
            for ($j = 1; $j <= $i; $j++) {
                if ($j % 4 == 0 && $j % 5 == 0) {
                    $output[] = 'helloworld';
                } elseif ($j % 4 == 0) {
                    $output[] = 'hello';
                } elseif ($j % 5 == 0) {
                    $output[] = 'world';
                } else {
                    $output[] = $j;
                }
            }
            $result[] = $output;
        }

        return view('hello-world.form', compact('result', 'n'));
    }
}
