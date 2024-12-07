<?php

use Modules\Auth\AuthGoogle\Http\Actions\AuthGoogleForgetAction;
use Modules\Auth\AuthGoogle\Http\Actions\AuthGoogleLinkAction;
use Illuminate\Support\Facades\Route;

Route::name('auth_google.')->prefix('authGoogle')->middleware(['api', 'auth'])->group(function () {
    Route::name('forget')->post('forget', AuthGoogleForgetAction::class);
    Route::name('link')->post('link', AuthGoogleLinkAction::class);
});
