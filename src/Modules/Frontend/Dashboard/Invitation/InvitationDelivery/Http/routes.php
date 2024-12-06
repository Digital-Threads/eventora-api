<?php

use Illuminate\Support\Facades\Route;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Http\Actions\InvitationDeliveryQueryAction;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Http\Actions\InvitationDeliverySendAction;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Http\Actions\InvitationDeliveryViewAction;

Route::prefix('invitations/delivery')->middleware(['api'])->group(function () {
    Route::post('/', InvitationDeliverySendAction::class)->name('invitations.delivery.send');
    Route::get('/', InvitationDeliveryQueryAction::class)->name('invitations.delivery.query');
    Route::get('/{id}', InvitationDeliveryViewAction::class)->name('invitations.delivery.view');
});
