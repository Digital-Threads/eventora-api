<?php

namespace Modules\OAuth\Services;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Infrastructure\Eloquent\Models\User;
use Laravel\Passport\Bridge\User as UserEntity;
use League\OAuth2\Server\Entities\UserEntityInterface;
use Modules\OAuth\Dto\OAuthPasswordDto;
use Modules\OAuth\Dto\OAuthPasswordSignupDto;

final class OAuthService
{
    public function __construct()
    {
        //
    }

    public function password(OAuthPasswordDto $request): ?UserEntityInterface
    {
        $query = User::query()->where('email', $request->username);

        /** @var null|User $user */
        $user = $query->first();

        if (!$user) {
            return null;
        }

        if (!Hash::check($request->password, $user->password)) {
            return null;
        }

        return new UserEntity($user->getAuthIdentifier());
    }

    public function passwordSignup(OAuthPasswordSignupDto $request): UserEntityInterface
    {
        $user = User::create([
            'email'         => $request->username,
            'password'      => Hash::make($request->password),
            'first_name'    => $request->firstName,
            'last_name'     => $request->lastName,
            'registered_at' => now(),
        ]);

        Event::dispatch('oauth.password_signed_up', [$user->id]);

        return new UserEntity($user->getAuthIdentifier());
    }
}
