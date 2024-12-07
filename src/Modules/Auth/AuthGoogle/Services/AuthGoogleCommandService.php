<?php

namespace Modules\Auth\AuthGoogle\Services;

use Modules\Auth\AuthGoogle\Dto\AuthGoogleForgetDto;
use Modules\Auth\AuthGoogle\Dto\AuthGoogleLinkDto;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Infrastructure\Eloquent\Models\User;
use Infrastructure\Socialite\Google\GoogleUserProvider;

final class AuthGoogleCommandService
{
    public function __construct(
        private readonly GoogleUserProvider $google,
    ) {
        //
    }

    public function link(AuthGoogleLinkDto $request): void
    {
        DB::transaction(function () use ($request): void {
            $user = User::findOrFail($request->userId);
            $source = $this->google->request($request->token);

            if (User::where('google_id', $source->id)->exists()) {
                throw new AuthorizationException();
            }

            $user->update([
                'google_id' => $source->id,
            ]);

            Event::dispatch('auth_google.linked', [$user->id]);
        });
    }

    public function forget(AuthGoogleForgetDto $request): void
    {
        DB::transaction(static function () use ($request): void {
            $user = User::findOrFail($request->userId);

            $user->update([
                'google_id' => null,
            ]);

            Event::dispatch('auth_google.forgot', [$user->id]);
        });
    }
}
