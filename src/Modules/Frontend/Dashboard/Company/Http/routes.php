<?php

use Illuminate\Support\Facades\Route;
use Modules\Frontend\Dashboard\Company\Http\Actions\CompanyViewAction;
use Modules\Frontend\Dashboard\Company\Http\Actions\CompanyCreateAction;
use Modules\Frontend\Dashboard\Company\Http\Actions\CompanyDeleteAction;
use Modules\Frontend\Dashboard\Company\Http\Actions\CompanyUpdateAction;

Route::prefix('companies')->middleware(['api'])->group(function () {
    Route::post('/', CompanyCreateAction::class)->name('companies.create');
    Route::put('/{id}', CompanyUpdateAction::class)->name('companies.update');
    Route::get('/{id}', CompanyViewAction::class)->name('companies.view');
    Route::delete('/{id}', CompanyDeleteAction::class)->name('companies.delete');
});
