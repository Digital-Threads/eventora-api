<?php

use Modules\Company\Http\Actions\CompanyCreateAction;
use Modules\Company\Http\Actions\CompanyDeleteAction;
use Modules\Company\Http\Actions\CompanyUpdateAction;
use Modules\Company\Http\Actions\CompanyViewAction;
use Illuminate\Support\Facades\Route;

Route::prefix('companies')->middleware(['api'])->group(function () {
    Route::post('/', CompanyCreateAction::class)->name('companies.create');
    Route::put('/{id}', CompanyUpdateAction::class)->name('companies.update');
    Route::get('/{id}', CompanyViewAction::class)->name('companies.view');
    Route::delete('/{id}', CompanyDeleteAction::class)->name('companies.delete');
});
