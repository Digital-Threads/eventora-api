<?php

use Modules\Role\Http\Actions\AssignRoleAction;
use Illuminate\Support\Facades\Route;

Route::prefix('roles')->group(function () {
    Route::post('/assign', AssignRoleAction::class); // Присвоение роли пользователю
});
