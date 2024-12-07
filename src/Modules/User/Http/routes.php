<?php

use Modules\User\Http\Actions\UserCreateAction;
use Modules\User\Http\Actions\UserUpdateAction;
use Modules\User\Http\Actions\UserViewAction;
use Illuminate\Support\Facades\Route;

Route::name('user.')->prefix('user')->middleware(['api'])->group(function () {
    Route::get('/', UserViewAction::class)->name('view');
    Route::put('/{user}', UserUpdateAction::class)->name('update');
    Route::post('/', UserCreateAction::class)->name('create');
});
