<?php

use Illuminate\Support\Facades\Route;
use Modules\Frontend\Dashboard\User\Http\Actions\UserCreateAction;
use Modules\Frontend\Dashboard\User\Http\Actions\UserUpdateAction;
use Modules\Frontend\Dashboard\User\Http\Actions\UserViewAction;

Route::name('user.')->prefix('user')->middleware(['api'])->group(function () {
    Route::get('/', UserViewAction::class)->name('view');
    Route::put('/{user}', UserUpdateAction::class)->name('update');
    Route::post('/', UserCreateAction::class)->name('create');
});
