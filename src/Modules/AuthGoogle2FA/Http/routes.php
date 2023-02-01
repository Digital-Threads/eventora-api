<?php

use Illuminate\Support\Facades\Route;
use Modules\AuthGoogle2FA\Http\Actions\AuthGoogle2FAIssueAction;
use Modules\AuthGoogle2FA\Http\Actions\AuthGoogle2FAEnableAction;
use Modules\AuthGoogle2FA\Http\Actions\AuthGoogle2FAForgetAction;
use Modules\AuthGoogle2FA\Http\Actions\AuthGoogle2FADisableAction;
use Modules\AuthGoogle2FA\Http\Actions\AuthGoogle2FAReissueAction;

Route::name('auth_google_2fa.')->prefix('authGoogle2FA')->middleware(['api', 'auth'])->group(function () {
    Route::name('issue')->post('issue', AuthGoogle2FAIssueAction::class);
    Route::name('reissue')->post('reissue', AuthGoogle2FAReissueAction::class);
    Route::name('forget')->post('forget', AuthGoogle2FAForgetAction::class);
    Route::name('disable')->post('disable', AuthGoogle2FADisableAction::class);
    Route::name('enable')->post('enable', AuthGoogle2FAEnableAction::class);
});
