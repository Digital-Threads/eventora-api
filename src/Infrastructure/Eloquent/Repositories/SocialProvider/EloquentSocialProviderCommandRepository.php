<?php

namespace Infrastructure\Eloquent\Repositories\SocialProvider;

use Domain\SocialProvider\Repositories\SocialProviderCommandRepositoryInterface;
use Infrastructure\Eloquent\Models\SocialProvider;

class EloquentSocialProviderCommandRepository implements SocialProviderCommandRepositoryInterface
{
    public function linkProvider(int $userId, string $providerName, string $providerId): SocialProvider
    {
        return SocialProvider::query()->updateOrCreate(
            ['user_id' => $userId, 'provider_name' => $providerName],
            ['provider_id' => $providerId]
        );
    }

    public function unlinkProvider(int $userId, string $providerName): void
    {
        SocialProvider::query()->where('user_id', $userId)
            ->where('provider_name', $providerName)
            ->delete();
    }

    public function unlinkAllProvidersForUser(int $userId): void
    {
        // TODO: Implement unlinkAllProvidersForUser() method.
    }
}
