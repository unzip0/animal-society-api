<?php

use App\Http\Controllers\Administration\Animals\AnimalsSpecies\AnimalSpeciesCreateController;
use App\Http\Controllers\Administration\Associations\AssociationsCreateController;
use App\Http\Controllers\Administration\Associations\AssociationsSearchController;
use App\Http\Controllers\Administration\Users\UsersLoginController;
use App\Http\Controllers\Administration\Users\UsersLogoutController;
use App\Http\Controllers\Administration\Users\UsersProfileController;
use App\Http\Controllers\Administration\Users\UsersRegisterController;
use App\Http\Controllers\Administration\Users\UsersUpdateController;
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
    
    Route::prefix('users')->group(function() {
        Route::post('register', UsersRegisterController::class);
        Route::post('login', UsersLoginController::class)->name('login');
    });

    Route::middleware('auth:api')->group(function() {
        
        Route::prefix('associations')->group(function() {
            Route::post('create', AssociationsCreateController::class);
            Route::get('all', AssociationsSearchController::class);
        });

        Route::prefix('users')->group(function() {
            Route::get('profile', UsersProfileController::class);
            Route::post('logout', UsersLogoutController::class);
            Route::patch('{id}', UsersUpdateController::class);
        });

        Route::prefix('animals')->group(function() {
            Route::prefix('species')->group(function() {
                Route::post('create', AnimalSpeciesCreateController::class);
            });
        });
     
    });
    
});

