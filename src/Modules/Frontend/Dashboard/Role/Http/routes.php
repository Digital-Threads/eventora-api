<?php

use Illuminate\Support\Facades\Route;
use Modules\Frontend\Dashboard\Role\Http\Actions\AssignRoleAction;

Route::prefix('roles')->group(function () {
    Route::post('/assign', AssignRoleAction::class); // Присвоение роли пользователю
});
