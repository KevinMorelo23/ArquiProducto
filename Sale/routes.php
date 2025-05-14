<?php

use Illuminate\Support\Facades\Route;
use Sale\Controllers\SaleController;

Route::group(['prefix' => 'sales'], function () {
    Route::get('/', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/create', [SaleController::class, 'create'])->name('sales.create');
    Route::post('/', [SaleController::class, 'store'])->name('sales.store');
    Route::get('/{sale}', [SaleController::class, 'show'])->name('sales.show');
    Route::get('/{sale}/invoice', [SaleController::class, 'invoice'])->name('sales.invoice');
    Route::delete('/{sale}', [SaleController::class, 'destroy'])->name('sales.destroy');
    Route::put('/{sale}', [SaleController::class, 'update'])->name('sales.update');
    Route::get('/{sale}/edit', [SaleController::class, 'edit'])->name('sales.edit');
});