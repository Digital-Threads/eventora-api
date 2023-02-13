<?php

use Illuminate\Support\Facades\Route;
use Modules\Frontend\BankAccount\Http\Actions\BankAccountViewAction;

Route::name('bankAccount.')->prefix('bankAccount')->middleware(['api','auth'])->group(function () {
    Route::name('view')->get('/{company_id}', BankAccountViewAction::class);
});
