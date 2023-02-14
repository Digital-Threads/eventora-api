<?php

use Illuminate\Support\Facades\Route;
use Modules\Frontend\BankAccount\Http\Actions\BankAccountCreateAction;
use Modules\Frontend\BankAccount\Http\Actions\BankAccountUpdateAction;
use Modules\Frontend\BankAccount\Http\Actions\BankAccountViewAction;

Route::name('bankAccount.')->prefix('bankAccount')->middleware(['api', 'auth'])->group(function () {
    Route::name('view')->get('/{bank}', BankAccountViewAction::class);
    Route::name('create')->post('/', BankAccountCreateAction::class);
    Route::name('update')->put('/{bankAccount}', BankAccountUpdateAction::class);
    Route::name('delete')->delete('/{bankAccount}', BankAccountUpdateAction::class);
});
