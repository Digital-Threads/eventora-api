<?php

use Illuminate\Support\Facades\Route;
use Modules\Frontend\CompanyType\Http\Actions\CompanyTypeViewAction;

Route::name('company_type.')->prefix('companyType')->middleware(['api'])->group(function () {
    Route::name('view')->get('/', CompanyTypeViewAction::class);
});
