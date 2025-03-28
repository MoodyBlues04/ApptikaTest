<?php

use Illuminate\Http\Request;
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

Route::middleware('logging')->group(function () {
    Route::prefix('app_top_category')
        ->as('app_top_category.')
        ->controller(\App\Http\Controllers\AppTopCategoryController::class)
        ->group(function() {
            Route::get('/', 'index')->name('index');
        });

});
