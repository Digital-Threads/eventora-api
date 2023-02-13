<?php

use Illuminate\Support\Facades\Route;
use Modules\Frontend\Company\Http\Actions\CompanyViewAction;

Route::name('company_type.')->prefix('company')->middleware(['api','auth'])->group(function () {
    Route::name('view')->get('/', CompanyViewAction::class);
});
