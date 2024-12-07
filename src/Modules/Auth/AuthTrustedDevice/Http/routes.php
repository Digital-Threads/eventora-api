<?php

use Modules\Auth\AuthTrustedDevice\Http\Actions\AuthTrustedDeviceDeleteAction;
use Modules\Auth\AuthTrustedDevice\Http\Actions\AuthTrustedDeviceQueryAction;
use Modules\Auth\AuthTrustedDevice\Http\Actions\AuthTrustedDeviceViewAction;
use Illuminate\Support\Facades\Route;

Route::name('auth_trusted_device.')->prefix('authTrustedDevice')->middleware(['api', 'auth'])->group(function () {
    Route::name('query')->get('/', AuthTrustedDeviceQueryAction::class);

    Route::prefix('{id}')->where(['id' => '[0-9]+'])->group(function () {
        Route::name('view')->get('/', AuthTrustedDeviceViewAction::class);
        Route::name('delete')->delete('/', AuthTrustedDeviceDeleteAction::class);
    });
});
