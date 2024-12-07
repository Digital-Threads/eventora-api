<?php

use Modules\Ticket\Http\Actions\TicketCreateAction;
use Modules\Ticket\Http\Actions\TicketDeleteAction;
use Modules\Ticket\Http\Actions\TicketQueryAction;
use Modules\Ticket\Http\Actions\TicketUpdateAction;
use Illuminate\Support\Facades\Route;

Route::name('ticket.')->prefix('ticket')->middleware(['api'])->group(function () {
    Route::post('/', TicketCreateAction::class);
    Route::put('/{id}', TicketUpdateAction::class);
    Route::delete('/{id}', TicketDeleteAction::class);
    Route::get('/', TicketQueryAction::class);
});
