<?php

use Illuminate\Support\Facades\Route;
use Modules\RraEbm\Livewire\Restaurant\RraEbm;

Route::middleware(['auth', config('jetstream.auth_session'), 'verified'])
    ->group(function () {
        Route::get('/rra-ebm', RraEbm::class)->name('rra-ebm.index');
    });