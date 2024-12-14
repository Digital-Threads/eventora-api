<?php

use Illuminate\Support\Facades\Route;
use Modules\Event\Http\Actions\Client\EventListIncomingAction;
use Modules\Event\Http\Actions\Client\EventListMonthlyAction;
use Modules\Event\Http\Actions\Client\EventListTodayAction;
use Modules\Event\Http\Actions\Client\EventListTopAction;
use Modules\Event\Http\Actions\Client\EventListWeeklyAction;
use Modules\Event\Http\Actions\Dashboard\EventCreateAction;
use Modules\Event\Http\Actions\Dashboard\EventQueryAction;
use Modules\Event\Http\Actions\Dashboard\EventUpdateAction;
use Modules\Event\Http\Actions\Dashboard\EventViewAction;

// Роуты для Dashboard
Route::prefix('dashboard/events')->middleware(['api', 'auth'])->group(function () {
    Route::post('/', EventCreateAction::class)->name('dashboard.events.create');
    Route::put('/{id}', EventUpdateAction::class)->name('dashboard.events.update');
    Route::get('/{id}', EventViewAction::class)->name('dashboard.events.view');
    Route::get('/', EventQueryAction::class)->name('dashboard.events.query');
});
// Роуты для Client
Route::prefix('events')->middleware(['api'])->group(function () {
    Route::get('/top', EventListTopAction::class)->name('events.top');
    Route::get('/today', EventListTodayAction::class)->name('events.today');
    Route::get('/week', EventListWeeklyAction::class)->name('events.week');
    Route::get('/month', EventListMonthlyAction::class)->name('events.month');
    Route::get('/incoming', EventListIncomingAction::class)->name('events.incoming');
});
