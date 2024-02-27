<?php

use App\Http\Controllers\Main\IndexController;
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

Route::get('/', IndexController::class);

Route::group(['prefix' => 'filling-packages'], function () {
    Route::get('/', \App\Http\Controllers\FillingPackages\IndexController::class)->name('filling-packages.index');
});

Route::group(['prefix' => 'directory'], function () {
    Route::get('/currency', \App\Http\Controllers\Directory\Currency\IndexController::class)->name('currency.index');
    Route::get('/currency/create', \App\Http\Controllers\Directory\Currency\CreateController::class)->name('currency.create');
    Route::post('/currency', \App\Http\Controllers\Directory\Currency\StoreController::class)->name('currency.store');
    Route::get('/currency/{currency}/edit', \App\Http\Controllers\Directory\Currency\EditController::class)->name('currency.edit');
    Route::patch('/currency/{currency}', \App\Http\Controllers\Directory\Currency\UpdateController::class)->name('currency.update');
    Route::delete('/currency/{currency}', \App\Http\Controllers\Directory\Currency\DeleteController::class)->name('currency.delete');
});

Route::group(['prefix' => 'directory'], function () {
    Route::get('/periods', \App\Http\Controllers\Directory\Periods\IndexController::class)->name('periods.index');
    Route::get('/periods/create', \App\Http\Controllers\Directory\Periods\CreateController::class)->name('periods.create');
    Route::post('/periods', \App\Http\Controllers\Directory\Periods\StoreController::class)->name('periods.store');
    Route::get('/periods/{currency}/edit', \App\Http\Controllers\Directory\Periods\EditController::class)->name('periods.edit');
    Route::patch('/periods/{currency}', \App\Http\Controllers\Directory\Periods\UpdateController::class)->name('periods.update');
    Route::delete('/periods/{currency}', \App\Http\Controllers\Directory\Periods\DeleteController::class)->name('periods.delete');
});

Route::group(['prefix' => 'directory'], function () {
    Route::get('/counterparties', \App\Http\Controllers\Directory\Counterparties\IndexController::class)->name('counterparties.index');
});

Route::group(['prefix' => 'directory'], function () {
    Route::get('/channels', \App\Http\Controllers\Directory\Channels\IndexController::class)->name('channels.index');
});

Route::group(['prefix' => 'directory'], function () {
    Route::get('/branches', \App\Http\Controllers\Directory\Branches\IndexController::class)->name('branches.index');
});

Route::group(['prefix' => 'directory'], function () {
    Route::get('/packages', \App\Http\Controllers\Directory\Packages\IndexController::class)->name('packages.index');
});

Route::group(['prefix' => 'agreement-card'], function () {
    Route::get('/', \App\Http\Controllers\AgreementCard\IndexController::class)->name('agreement-card.index');
});

Route::group(['prefix' => 'subscribers'], function () {
    Route::get('/', \App\Http\Controllers\Subscribers\IndexController::class)->name('subscribers.index');
});

Route::group(['prefix' => 'channels'], function () {
    Route::get('/', \App\Http\Controllers\Channels\IndexController::class)->name('channels.index');
});

Route::group(['prefix' => 'calculations'], function () {
    Route::get('/', \App\Http\Controllers\Calculations\IndexController::class)->name('calculations.index');
});


