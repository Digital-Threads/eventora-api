<?php
namespace Domain\SocialProvider\Repositories;

use Infrastructure\Eloquent\Models\SocialProvider;

interface SocialProviderCommandRepositoryInterface
{
    public function linkProvider(int $userId, string $providerName, string $providerId): SocialProvider;

    public function unlinkProvider(int $userId, string $providerName): void;

    public function unlinkAllProvidersForUser(int $userId): void;

}

