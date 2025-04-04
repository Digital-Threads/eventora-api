<?php

use Modules\Tag\Http\Actions\TagCreateAction;
use Modules\Tag\Http\Actions\TagSearchAction;
use Illuminate\Support\Facades\Route;

Route::name('tags.')->prefix('tags')->middleware(['api', 'auth'])->group(function () {
    Route::name('create')->post('/', TagCreateAction::class);
    Route::name('search')->get('/search', TagSearchAction::class);
});
