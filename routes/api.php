<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CreateController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\UpdateController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register_user', [AuthController::class, 'register']);
Route::post('/login/{otp?}', [AuthController::class, 'login']);
Route::post('/get_otp', [AuthController::class, 'generate_otp']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/get_record', [ViewController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/get_mumeneen', [ViewController::class, 'mumeneen']);
    Route::get('/get_events', [ViewController::class, 'events']);
    Route::get('/events', [ViewController::class, 'get_events']);

    Route::post('/get_scan', [CreateController::class, 'scanning']);

    Route::patch('/update_user', [UpdateController::class, 'user']);

    Route::patch('/update_mumeneen/{id}', [UpdateController::class, 'mumeneen']);

    Route::post('/import_users', [CsvImportController::class, 'importUser']);
});