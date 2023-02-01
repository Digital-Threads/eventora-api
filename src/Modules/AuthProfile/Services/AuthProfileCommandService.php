<?php

namespace Modules\AuthProfile\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Infrastructure\Eloquent\Models\User;
use Modules\AuthProfile\Dto\AuthProfileUpdateDto;

final class AuthProfileCommandService
{
    public function update(AuthProfileUpdateDto $request): void
    {
        DB::transaction(static function () use ($request): void {
            $user = User::findOrFail($request->userId);

            $user->update([
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
            ]);

            Event::dispatch('auth_profile.updated', [$user->id]);
        });
    }
}
