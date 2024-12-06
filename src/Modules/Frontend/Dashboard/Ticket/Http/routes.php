<?php

use Illuminate\Support\Facades\Route;
use Modules\Frontend\Dashboard\Ticket\Http\Actions\TicketCreateAction;
use Modules\Frontend\Dashboard\Ticket\Http\Actions\TicketDeleteAction;
use Modules\Frontend\Dashboard\Ticket\Http\Actions\TicketQueryAction;
use Modules\Frontend\Dashboard\Ticket\Http\Actions\TicketUpdateAction;

Route::name('ticket.')->prefix('ticket')->middleware(['api'])->group(function () {
    Route::post('/', TicketCreateAction::class);
    Route::put('/{id}', TicketUpdateAction::class);
    Route::delete('/{id}', TicketDeleteAction::class);
    Route::get('/', TicketQueryAction::class);
});
