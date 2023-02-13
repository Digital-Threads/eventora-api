<?php

use Illuminate\Support\Facades\Route;
use Modules\Frontend\BankCard\Http\Actions\BankCardViewAction;

Route::name('bankCard.')->prefix('bankCard')->middleware(['api','auth'])->group(function () {
    Route::name('view')->get('/{bank}', BankCardViewAction::class);
});
