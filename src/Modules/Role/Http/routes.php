<?php

use Illuminate\Support\Facades\Route;
use Modules\Role\Http\Actions\AssignRoleAction;

Route::prefix('roles')->group(function () {
    Route::post('/assign', AssignRoleAction::class); // Присвоение роли пользователю
});
