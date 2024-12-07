<?php

use Modules\Auth\AuthFacebook\Http\Actions\AuthFacebookForgetAction;
use Modules\Auth\AuthFacebook\Http\Actions\AuthFacebookLinkAction;
use Illuminate\Support\Facades\Route;

Route::name('auth_facebook.')->prefix('authFacebook')->middleware(['api', 'auth'])->group(function () {
    Route::name('forget')->post('forget', AuthFacebookForgetAction::class);
    Route::name('link')->post('link', AuthFacebookLinkAction::class);
});
