<?php

use Modules\Auth\AuthPassword\Http\Actions\AuthPasswordForgetAction;
use Modules\Auth\AuthPassword\Http\Actions\AuthPasswordResetAction;
use Modules\Auth\AuthPassword\Http\Actions\AuthPasswordSendResetLinkAction;
use Modules\Auth\AuthPassword\Http\Actions\AuthPasswordUpdateAction;
use Illuminate\Support\Facades\Route;

Route::name('auth_password.')->prefix('authPassword')->middleware(['api'])->group(function () {
    Route::name('send_reset_link')->post('sendResetLink', AuthPasswordSendResetLinkAction::class);
    Route::name('reset')->post('reset', AuthPasswordResetAction::class);

    Route::middleware(['auth'])->group(function () {
        Route::name('update')->post('update', AuthPasswordUpdateAction::class);
        Route::name('forget')->post('forget', AuthPasswordForgetAction::class);
    });
});
