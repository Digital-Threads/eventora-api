<?php

use Modules\Invitation\InvitationDelivery\Http\Actions\InvitationDeliveryQueryAction;
use Modules\Invitation\InvitationDelivery\Http\Actions\InvitationDeliverySendAction;
use Modules\Invitation\InvitationDelivery\Http\Actions\InvitationDeliveryViewAction;
use Illuminate\Support\Facades\Route;

Route::prefix('invitations/delivery')->middleware(['api'])->group(function () {
    Route::post('/', InvitationDeliverySendAction::class)->name('invitations.delivery.send');
    Route::get('/', InvitationDeliveryQueryAction::class)->name('invitations.delivery.query');
    Route::get('/{id}', InvitationDeliveryViewAction::class)->name('invitations.delivery.view');
});
