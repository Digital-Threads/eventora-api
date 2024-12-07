<?php

use Modules\Auth\AuthEmail\Http\Actions\AuthEmailForgetAction;
use Modules\Auth\AuthEmail\Http\Actions\AuthEmailSendVerificationLinkAction;
use Modules\Auth\AuthEmail\Http\Actions\AuthEmailUpdateAction;
use Modules\Auth\AuthEmail\Http\Actions\AuthEmailVerifyAction;
use Illuminate\Support\Facades\Route;

Route::name('auth_email.')->prefix('authEmail')->middleware(['api'])->group(function () {
    Route::name('verify_email')->middleware(['throttle:10,1'])->post('verify', AuthEmailVerifyAction::class);

    Route::middleware(['auth'])->group(function () {
        Route::name('send_verification_link')->middleware(['throttle:3,10'])->post('sendVerificationLink', AuthEmailSendVerificationLinkAction::class);
        Route::name('update')->post('update', AuthEmailUpdateAction::class);
        Route::name('forget')->post('forget', AuthEmailForgetAction::class);
    });
});
