<?php

use Modules\Auth\AuthProfile\Http\Actions\AuthProfileUpdateAction;
use Modules\Auth\AuthProfile\Http\Actions\AuthProfileViewAction;
use Illuminate\Support\Facades\Route;

Route::name('auth_profile.')->prefix('authProfile')->middleware(['api', 'auth'])->group(function () {
    Route::name('view')->get('/', AuthProfileViewAction::class);
    Route::name('update')->put('/', AuthProfileUpdateAction::class);
});
