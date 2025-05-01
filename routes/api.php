<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SmartEnergyController;
use App\Http\Controllers\Api\SmartAgricultureController;
use App\Http\Controllers\Api\SmartHomeController;
use App\Http\Controllers\Api\GetAllDataController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/smart-energy/send', [SmartEnergyController::class, 'receive']);
Route::post('/smart-agriculture/send', [SmartAgricultureController::class, 'receive']);
Route::post('/smart-home/send', [SmartHomeController::class, 'receive']);
Route::post('/login', [GetAllDataController::class, 'login']);
// routes/api.php
// routes/api.php
Route::middleware('auth:sanctum')->get('/sensor-data', [GetAllDataController::class, 'getSensorData']);