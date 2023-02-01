<?php

use Illuminate\Support\Facades\Route;
use Modules\Example\Http\Actions\QueryAction;

Route::name('example.')->prefix('example')->middleware(['api'])->group(function () {
    Route::name('query')->get('/', QueryAction::class);
});
