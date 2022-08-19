<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HdfController;
use App\Http\Controllers\Api\ScannerController;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/hdf/update', [HdfController::class, 'register_hdf']);
    Route::get('/scan-lists', [ScannerController::class, 'scan_lists']);
    Route::post('/scan', [ScannerController::class, 'scan']);
    Route::post('/logout', [AuthController::class, 'logout']);
});