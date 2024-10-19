<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Actions\UserViewAction;
use Modules\User\Http\Actions\UserCreateAction;
use Modules\User\Http\Actions\UserUpdateAction;

Route::name('user.')->prefix('user')->middleware(['api'])->group(function () {
    Route::get('/', UserViewAction::class)->name('view');
    Route::put('/', UserUpdateAction::class)->name('update');
    Route::post('/', UserCreateAction::class)->name('create');
});
