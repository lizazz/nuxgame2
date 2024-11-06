<?php

use Illuminate\Support\Facades\Route;
use Modules\Imfeelinglucky\App\Http\Controllers\HashController;
use Modules\Imfeelinglucky\App\Http\Controllers\ImfeelingluckyController;
use Modules\Imfeelinglucky\App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'imfeelinglucky'], function () {
    Route::get('/', [UserController::class, 'create'])->name('user.create');
    Route::post('/', [UserController::class, 'store'])->name('user.store');
    Route::get('/{hash}', [HashController::class, 'show'])->name('imfeelinglucky.show');
    Route::get('/{hash}/generate', [HashController::class, 'generate'])
        ->name('imfeelinglucky.generate');
    Route::get('/{hash}/deactivate', [HashController::class, 'deactivate'])
        ->name('imfeelinglucky.deactivate');
    Route::get('/{hash}/try', [ImfeelingluckyController::class, 'try'])
        ->name('imfeelinglucky.try');
    Route::get('/{hash}/history', [ImfeelingluckyController::class, 'history'])
        ->name('imfeelinglucky.history');
});
