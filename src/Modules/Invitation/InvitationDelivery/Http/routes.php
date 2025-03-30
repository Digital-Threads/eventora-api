<?php

use Illuminate\Support\Facades\Route;
use Modules\Invitation\InvitationDelivery\Http\Actions\InvitationDeliveryQueryAction;
use Modules\Invitation\InvitationDelivery\Http\Actions\InvitationDeliverySendAction;
use Modules\Invitation\InvitationDelivery\Http\Actions\InvitationDeliveryViewAction;
use Modules\Invitation\InvitationDelivery\Http\Actions\InvitationDeliveryResponseAction;

Route::prefix('invitations/delivery')->middleware(['api'])->group(function () {
    Route::post('/respond', InvitationDeliveryResponseAction::class)->name('invitations.delivery.respond');
    Route::post('/', InvitationDeliverySendAction::class)->name('invitations.delivery.send');
    Route::get('/{id}', InvitationDeliveryViewAction::class)->name('invitations.delivery.view');
    Route::get('/', InvitationDeliveryQueryAction::class)->name('invitations.delivery.query');
});
