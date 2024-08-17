<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobApplicationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::post('jobs', [JobController::class, 'store']);
    Route::put('jobs/{job}', [JobController::class, 'update']);
    Route::delete('jobs/{job}', [JobController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('jobs', JobController::class)->only(['index', 'show']);
    Route::post('jobs/{job}/apply', [JobApplicationController::class, 'apply']);
    Route::get('jobs/{job}/applications', [JobApplicationController::class, 'index']);
    Route::post('jobs/search', [JobController::class, 'search']);
    Route::post('logout', [AuthController::class, 'logout']);
});