<?php

use Modules\Event\Http\Actions\EventCreateAction;
use Modules\Event\Http\Actions\EventQueryAction;
use Modules\Event\Http\Actions\EventUpdateAction;
use Modules\Event\Http\Actions\EventViewAction;
use Illuminate\Support\Facades\Route;

Route::prefix('events')->middleware(['api'])->group(function () {
    Route::post('/', EventCreateAction::class)->name('events.create');
    Route::put('/{id}', EventUpdateAction::class)->name('events.update');
    Route::get('/{id}', EventViewAction::class)->name('events.update');
    Route::get('/', EventQueryAction::class)->name('events.update');
});
