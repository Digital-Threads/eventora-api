<?php

use Illuminate\Support\Facades\Route;
use Modules\Invitation\Http\Actions\InvitationCreateAction;
use Modules\Invitation\Http\Actions\InvitationUpdateAction;
use Modules\Invitation\Http\Actions\InvitationViewAction;
use Modules\Invitation\Http\Actions\InvitationQueryAction;

Route::prefix('invitations')->middleware(['api'])->group(function () {
    Route::get('/', InvitationQueryAction::class)->name('invitations.query');
//    Route::get('/{id}', InvitationViewAction::class)->name('invitations.view');
//    Route::post('/', InvitationCreateAction::class)->name('invitations.create');
//    Route::put('/{id}', InvitationUpdateAction::class)->name('invitations.update');
});
