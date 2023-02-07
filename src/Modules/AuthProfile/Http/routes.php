<?php

use Illuminate\Support\Facades\Route;
use Modules\AuthProfile\Http\Actions\AuthProfileUpdateAction;
use Modules\AuthProfile\Http\Actions\AuthProfileViewAction;

Route::name('auth_profile.')->prefix('authProfile')->middleware(['api', 'auth'])->group(function () {
    Route::name('view')->get('/', AuthProfileViewAction::class);
    Route::name('update')->put('/', AuthProfileUpdateAction::class);
});
