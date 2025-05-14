<?php

use Illuminate\Support\Facades\Route;
use Promociones\Controllers\PromocionController;

Route::group(['prefix' => 'promociones'], function () {
    Route::get('/', [PromocionController::class, 'index'])->name('promociones.index');
    Route::get('/create', [PromocionController::class, 'create'])->name('promociones.create');
    Route::post('/', [PromocionController::class, 'store'])->name('promociones.store');
    Route::get('/{promocion}', [PromocionController::class, 'show'])->name('promociones.show');
    Route::get('/{promocion}/edit', [PromocionController::class, 'edit'])->name('promociones.edit');
    Route::put('/{promocion}', [PromocionController::class, 'update'])->name('promociones.update');
    Route::delete('/{promocion}', [PromocionController::class, 'destroy'])->name('promociones.destroy');
});