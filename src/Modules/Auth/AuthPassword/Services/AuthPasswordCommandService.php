<?php

namespace Modules\Auth\AuthPassword\Services;

use Modules\Auth\AuthPassword\Dto\AuthPasswordForgetDto;
use Modules\Auth\AuthPassword\Dto\AuthPasswordResetDto;
use Modules\Auth\AuthPassword\Dto\AuthPasswordSendResetLinkDto;
use Modules\Auth\AuthPassword\Dto\AuthPasswordUpdateDto;
use Modules\Auth\AuthPassword\Exceptions\AuthPasswordResetFailedException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Infrastructure\Eloquent\Models\User;

final class AuthPasswordCommandService
{
    public function sendResetLink(AuthPasswordSendResetLinkDto $request): void
    {
        DB::transaction(static function () use ($request): void {
            $status = Password::sendResetLink(['email' => $request->email]);

            if ($status !== Password::RESET_LINK_SENT) {
                throw new AuthPasswordResetFailedException();
            }

            Event::dispatch('auth_password.reset_link_sent', [$request->email]);
        });
    }

    public function reset(AuthPasswordResetDto $request): void
    {
        $credentials = [
            'email' => $request->email,
            'token' => $request->token,
            'password' => $request->password,
        ];

        $status = Password::reset($credentials, static function ($user, $password): void {
            $user->update([
                'password' => Hash::make($password),
                'password_changed_at' => now(),
            ]);

            Event::dispatch('auth_password.reset', [$user->id]);
        });

        if ($status !== Password::PASSWORD_RESET) {
            throw new AuthPasswordResetFailedException();
        }
    }

    public function update(AuthPasswordUpdateDto $request): void
    {
        DB::transaction(static function () use ($request): void {
            $user = User::findOrFail($request->userId);

            $user->update([
                'password' => Hash::make($request->password),
                'password_changed_at' => now(),
            ]);

            Event::dispatch('auth_password.updated', [$user->id]);
        });
    }

    public function forget(AuthPasswordForgetDto $request): void
    {
        DB::transaction(static function () use ($request): void {
            $user = User::findOrFail($request->userId);

            $user->update([
                'password' => null,
                'password_changed_at' => null,
            ]);

            Event::dispatch('auth_password.forgot', [$user->id]);
        });
    }
}
