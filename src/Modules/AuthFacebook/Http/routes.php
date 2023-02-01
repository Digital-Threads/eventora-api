<?php

use Illuminate\Support\Facades\Route;
use Modules\AuthFacebook\Http\Actions\AuthFacebookLinkAction;
use Modules\AuthFacebook\Http\Actions\AuthFacebookForgetAction;

Route::name('auth_facebook.')->prefix('authFacebook')->middleware(['api', 'auth'])->group(function () {
    Route::name('forget')->post('forget', AuthFacebookForgetAction::class);
    Route::name('link')->post('link', AuthFacebookLinkAction::class);
});
