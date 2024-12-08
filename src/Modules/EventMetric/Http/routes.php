<?php

use Modules\EventMetric\Http\Actions\EventMetricPopularAction;
use Modules\EventMetric\Http\Actions\EventMetricViewAction;
use Illuminate\Support\Facades\Route;

Route::prefix('event-metrics')->middleware(['api'])->group(function () {
    Route::get('/popular', EventMetricPopularAction::class)->name('event-metrics.popular');
    Route::get('/{eventId}', EventMetricViewAction::class)->name('event-metrics.view');
});
