<?php

use Illuminate\Support\Facades\Route;
use Modules\AuthTrustedDevice\Http\Actions\AuthTrustedDeviceViewAction;
use Modules\AuthTrustedDevice\Http\Actions\AuthTrustedDeviceQueryAction;
use Modules\AuthTrustedDevice\Http\Actions\AuthTrustedDeviceDeleteAction;

Route::name('auth_trusted_device.')->prefix('authTrustedDevice')->middleware(['api', 'auth'])->group(function () {
    Route::name('query')->get('/', AuthTrustedDeviceQueryAction::class);

    Route::prefix('{id}')->where(['id' => '[0-9]+'])->group(function () {
        Route::name('view')->get('/', AuthTrustedDeviceViewAction::class);
        Route::name('delete')->delete('/', AuthTrustedDeviceDeleteAction::class);
    });
});
