<?php

use Illuminate\Support\Facades\Route;
use Modules\EventCategory\Http\Actions\EventCategoryQueryAction;

Route::prefix('event-category')->middleware(['api'])->group(function () {
    Route::get('/', EventCategoryQueryAction::class)->name('events.top');
});
