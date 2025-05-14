<?php

use Illuminate\Support\Facades\Route;
use Report\Controllers\ReportController;

Route::group(['prefix' => 'reports'], function () {
    Route::get('/', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/sales', [ReportController::class, 'sales'])->name('reports.sales');
    Route::get('/products', [ReportController::class, 'products'])->name('reports.products');
    Route::get('/customers', [ReportController::class, 'customers'])->name('reports.customers');
});