<?php

use Illuminate\Support\Facades\Route;
use Modules\Frontend\BankCard\Http\Actions\BankCardCreateAction;
use Modules\Frontend\BankCard\Http\Actions\BankCardUpdateAction;
use Modules\Frontend\BankCard\Http\Actions\BankCardViewAction;

Route::name('bankCard.')->prefix('bankCard')->middleware(['api', 'auth'])->group(function () {
    Route::name('view')->get('/{bank}', BankCardViewAction::class);
    Route::name('create')->post('/', BankCardCreateAction::class);
    Route::name('update')->put('/{bankCard}', BankCardUpdateAction::class);
    Route::name('delete')->delete('/{bankCard}', BankCardUpdateAction::class);
});
