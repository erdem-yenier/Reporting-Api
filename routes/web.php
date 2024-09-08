<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Auth\LoginController;

Route::as('auth.')
    ->group(function () {
        Route::controller(LoginController::class)->group(function () {
            Route::get('login', 'login')->name('login');
            Route::post('login', 'loginPost')->name('login.post');
            Route::get('logout', 'logout')->name('logout');
        });
    });

### dashboard index
Route::controller(MainController::class)
    ->middleware(['authLogin'])
    ->as('dashboard.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/report', 'report')->name('report');
        Route::post('/report', 'reportPost')->name('report.post');
        Route::get('/query', 'query')->name('query');
        Route::get('/transaction', 'transaction')->name('transaction');
        Route::get('/client', 'client')->name('client');
    });

