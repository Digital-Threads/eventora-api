<?php

use Illuminate\Support\Facades\Route;
use Modules\AuthGoogle\Http\Actions\AuthGoogleLinkAction;
use Modules\AuthGoogle\Http\Actions\AuthGoogleForgetAction;

Route::name('auth_google.')->prefix('authGoogle')->middleware(['api', 'auth'])->group(function () {
    Route::name('forget')->post('forget', AuthGoogleForgetAction::class);
    Route::name('link')->post('link', AuthGoogleLinkAction::class);
});
