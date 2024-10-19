<?php

use Illuminate\Support\Facades\Route;
use Modules\Invitation\Http\Actions\InvitationViewAction;
use Modules\Invitation\Http\Actions\InvitationQueryAction;
use Modules\Invitation\Http\Actions\InvitationCreateAction;
use Modules\Invitation\Http\Actions\InvitationUpdateAction;

Route::prefix('invitations')->middleware(['api'])->group(function () {
    Route::post('/', InvitationCreateAction::class)->name('invitations.create');
    Route::put('/{id}', InvitationUpdateAction::class)->name('invitations.update');
    Route::get('/', InvitationQueryAction::class)->name('invitations.query');
    Route::get('/{id}', InvitationViewAction::class)->name('invitations.view');
});
