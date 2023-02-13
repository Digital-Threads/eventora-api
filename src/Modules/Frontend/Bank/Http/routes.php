<?php

use Illuminate\Support\Facades\Route;
use Modules\Frontend\Bank\Http\Actions\BankViewAction;

Route::name('bank.')->prefix('bank')->middleware(['api','auth'])->group(function () {
    Route::name('view')->get('/{company_id}', BankViewAction::class);
});
