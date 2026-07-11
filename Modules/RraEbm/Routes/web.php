<?php

use Illuminate\Support\Facades\Route;
use Modules\RraEbm\Http\Controllers\AdminRraEbmController;

Route::prefix('superadmin/rra-ebm')
    ->middleware(['auth', 'superadmin'])
    ->name('superadmin.rra-ebm.')
    ->group(function () {
        Route::get('/', [AdminRraEbmController::class, 'index'])->name('index');
        Route::get('/create/{branch?}', [AdminRraEbmController::class, 'create'])->name('create');
        Route::post('/', [AdminRraEbmController::class, 'store'])->name('store');
        Route::get('/{setting}/edit', [AdminRraEbmController::class, 'edit'])->name('edit');
        Route::put('/{setting}', [AdminRraEbmController::class, 'update'])->name('update');
        Route::delete('/{setting}', [AdminRraEbmController::class, 'destroy'])->name('destroy');
        Route::post('/{setting}/initialize', [AdminRraEbmController::class, 'initialize'])->name('initialize');
    });
