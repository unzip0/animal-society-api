<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('test-cache-redis', function() {
    Cache::store('redis')->put('Laradock', 'Awesome', 100);
});

Route::get('test-redis', function() {
    \App\Jobs\TestJob::dispatch(['email' => 'apcabrera08@gmail.com']);
});
