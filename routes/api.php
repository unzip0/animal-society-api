<?php

use App\Http\Controllers\Administration\Associations\AssociationsCreateController;
use App\Http\Controllers\Administration\Associations\AssociationsSearchController;
use App\Http\Controllers\Administration\Users\UsersRegisterController;
use App\Http\Controllers\HealthCheck\HealthCheckGetController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    abort(404);
});

Route::get('/health-check', HealthCheckGetController::class);

Route::prefix('v1')->group(function () {
    Route::post('/users/register', UsersRegisterController::class);
    Route::post('/associations', AssociationsCreateController::class);
    Route::get('/associations', AssociationsSearchController::class);
});

