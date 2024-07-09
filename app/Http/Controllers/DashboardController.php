<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Infrastructures\Services\OrderService;
use App\Infrastructures\Services\ProductService;

class DashboardController extends Controller
{
    protected $orderService;
    protected $productService;

    public function __construct()
    {

    }

    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function dashboard()
    {
        return view('dashboards.dashboard');
    }
}
