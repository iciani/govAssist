<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UrlController;
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

Route::controller(AuthController::class)->group(function () {
    Route::group(['prefix' => 'auths'], function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
    });
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::apiResource('urls', UrlController::class)->only(['index', 'store', 'show', 'destroy']);
    Route::post('/urls/state', [UrlController::class, 'stateUpdate'])->name('urls.state.update');
});
