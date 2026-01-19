<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LaundryTransactionController;
use App\Http\Controllers\OverheadCostController;
use App\Http\Controllers\RawMaterialController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('raw-materials.index'));

Route::prefix('management')->group(function () {
    Route::resource('raw-materials', RawMaterialController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('overhead-costs', OverheadCostController::class);
});

/* =====================
   LAUNDRY TRANSACTION
===================== */

Route::get(
    'laundry-transactions/step-2',
    [LaundryTransactionController::class, 'step2']
)->name('laundry-transactions.step2');

Route::post(
    'laundry-transactions/step-2',
    [LaundryTransactionController::class, 'storeStep2']
)->name('laundry-transactions.step2.store');

Route::get(
    'laundry-transactions/step-3',
    [LaundryTransactionController::class, 'step3']
)->name('laundry-transactions.step3');

Route::get(
    'laundry-transactions/hpp',
    [LaundryTransactionController::class, 'hpp']
)->name('laundry-transactions.hpp');

Route::post(
    'laundry-transactions/final',
    [LaundryTransactionController::class, 'storeFinal']
)->name('laundry-transactions.final');

/* STEP 1 */
Route::post(
    'laundry-transactions',
    [LaundryTransactionController::class, 'storeStep1']
)->name('laundry-transactions.store');

/* RESOURCE */
Route::resource('laundry-transactions', LaundryTransactionController::class)
    ->except(['store', 'show']);
