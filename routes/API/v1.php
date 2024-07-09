<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Select2Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('select2')->group(function () {
    Route::post('/suppliers', [Select2Controller::class, 'getSuppliers']);
    Route::post('/types', [Select2Controller::class, 'getTypes']);
});
