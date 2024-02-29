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
    Route::group(['prefix' => 'currency'], function () {
        Route::get('/', \App\Http\Controllers\Directory\Currency\IndexController::class)->name('currency.index');
        Route::get('/create', \App\Http\Controllers\Directory\Currency\CreateController::class)->name('currency.create');
        Route::post('/', \App\Http\Controllers\Directory\Currency\StoreController::class)->name('currency.store');
        Route::get('/{currency}/edit', \App\Http\Controllers\Directory\Currency\EditController::class)->name('currency.edit');
        Route::patch('/{currency}', \App\Http\Controllers\Directory\Currency\UpdateController::class)->name('currency.update');
        Route::delete('/{currency}', \App\Http\Controllers\Directory\Currency\DeleteController::class)->name('currency.delete');
    });

    Route::group(['prefix' => 'periods'], function () {
        Route::get('/', \App\Http\Controllers\Directory\Periods\IndexController::class)->name('periods.index');
        Route::get('/create', \App\Http\Controllers\Directory\Periods\CreateController::class)->name('periods.create');
        Route::post('/', \App\Http\Controllers\Directory\Periods\StoreController::class)->name('periods.store');
        Route::get('/{period}/edit', \App\Http\Controllers\Directory\Periods\EditController::class)->name('periods.edit');
        Route::patch('/{period}', \App\Http\Controllers\Directory\Periods\UpdateController::class)->name('periods.update');
        Route::delete('/{period}', \App\Http\Controllers\Directory\Periods\DeleteController::class)->name('periods.delete');
    });

    Route::group(['prefix' => 'counterparties'], function () {
        Route::get('/', \App\Http\Controllers\Directory\Counterparties\IndexController::class)->name('counterparties.index');
        Route::get('/create', \App\Http\Controllers\Directory\Counterparties\CreateController::class)->name('counterparties.create');
        Route::post('/', \App\Http\Controllers\Directory\Counterparties\StoreController::class)->name('counterparties.store');
        Route::get('/{counterparty}/edit', \App\Http\Controllers\Directory\Counterparties\EditController::class)->name('counterparties.edit');
        Route::patch('/{counterparty}', \App\Http\Controllers\Directory\Counterparties\UpdateController::class)->name('counterparties.update');
        Route::delete('/{counterparty}', \App\Http\Controllers\Directory\Counterparties\DeleteController::class)->name('counterparties.delete');
    });

    Route::group(['prefix' => 'channels'], function () {
        Route::get('/', \App\Http\Controllers\Directory\Channels\IndexController::class)->name('channels.index');
        Route::get('/create', \App\Http\Controllers\Directory\Channels\CreateController::class)->name('channels.create');
        Route::post('/', \App\Http\Controllers\Directory\Channels\StoreController::class)->name('channels.store');
        Route::get('/{channel}/edit', \App\Http\Controllers\Directory\Channels\EditController::class)->name('channels.edit');
        Route::patch('/{channel}', \App\Http\Controllers\Directory\Channels\UpdateController::class)->name('channels.update');
        Route::delete('/{channel}', \App\Http\Controllers\Directory\Channels\DeleteController::class)->name('channels.delete');
    });

    Route::group(['prefix' => 'channels-categories'], function () {
        Route::get('/', \App\Http\Controllers\Directory\ChannelsCategories\IndexController::class)->name('channels-categories.index');
        Route::get('/create', \App\Http\Controllers\Directory\ChannelsCategories\CreateController::class)->name('channels-categories.create');
        Route::post('/', \App\Http\Controllers\Directory\ChannelsCategories\StoreController::class)->name('channels-categories.store');
        Route::get('/{category}/edit', \App\Http\Controllers\Directory\ChannelsCategories\EditController::class)->name('channels-categories.edit');
        Route::patch('/{category}', \App\Http\Controllers\Directory\ChannelsCategories\UpdateController::class)->name('channels-categories.update');
        Route::delete('/{category}', \App\Http\Controllers\Directory\ChannelsCategories\DeleteController::class)->name('channels-categories.delete');
    });

    Route::group(['prefix' => 'departments'], function () {
        Route::get('/', \App\Http\Controllers\Directory\Departments\IndexController::class)->name('departments.index');
    });

    Route::group(['prefix' => 'packages'], function () {
        Route::get('/', \App\Http\Controllers\Directory\Packages\IndexController::class)->name('packages.index');
        Route::get('/create', \App\Http\Controllers\Directory\Packages\CreateController::class)->name('packages.create');
        Route::post('/', \App\Http\Controllers\Directory\Packages\StoreController::class)->name('packages.store');
        Route::get('/{package}/edit', \App\Http\Controllers\Directory\Packages\EditController::class)->name('packages.edit');
        Route::patch('/{package}', \App\Http\Controllers\Directory\Packages\UpdateController::class)->name('packages.update');
        Route::delete('/{package}', \App\Http\Controllers\Directory\Packages\DeleteController::class)->name('packages.delete');
    });

});

Route::group(['prefix' => 'agreements-cards'], function () {
    Route::get('/', \App\Http\Controllers\AgreementsCards\IndexController::class)->name('agreements-cards.index');
});

Route::group(['prefix' => 'subscribers'], function () {
    Route::get('/', \App\Http\Controllers\Subscribers\IndexController::class)->name('subscribers.index');
});

Route::group(['prefix' => 'channels'], function () {
    Route::get('/', \App\Http\Controllers\Channels\IndexController::class)->name('channels');
});

Route::group(['prefix' => 'calculations'], function () {
    Route::get('/', \App\Http\Controllers\Calculations\IndexController::class)->name('calculations.index');
});


