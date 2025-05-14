<?php

use Illuminate\Support\Facades\Route;
use Provider\Controllers\ProviderController;

Route::group(['prefix' => 'providers'], function () {
    Route::get('/', [ProviderController::class, 'index'])->name('providers.index');
    Route::get('/create', [ProviderController::class, 'create'])->name('providers.create');
    Route::post('/', [ProviderController::class, 'store'])->name('providers.store');
    Route::get('/{provider}', [ProviderController::class, 'show'])->name('providers.show');
    Route::get('/{provider}/edit', [ProviderController::class, 'edit'])->name('providers.edit');
    Route::put('/{provider}', [ProviderController::class, 'update'])->name('providers.update');
    Route::delete('/{provider}', [ProviderController::class, 'destroy'])->name('providers.destroy');
});