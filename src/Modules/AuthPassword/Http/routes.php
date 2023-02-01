<?php

use Illuminate\Support\Facades\Route;
use Modules\AuthPassword\Http\Actions\AuthPasswordResetAction;
use Modules\AuthPassword\Http\Actions\AuthPasswordForgetAction;
use Modules\AuthPassword\Http\Actions\AuthPasswordUpdateAction;
use Modules\AuthPassword\Http\Actions\AuthPasswordSendResetLinkAction;

Route::name('auth_password.')->prefix('authPassword')->middleware(['api'])->group(function () {
    Route::name('send_reset_link')->post('sendResetLink', AuthPasswordSendResetLinkAction::class);
    Route::name('reset')->post('reset', AuthPasswordResetAction::class);

    Route::middleware(['auth'])->group(function () {
        Route::name('update')->post('update', AuthPasswordUpdateAction::class);
        Route::name('forget')->post('forget', AuthPasswordForgetAction::class);
    });
});
