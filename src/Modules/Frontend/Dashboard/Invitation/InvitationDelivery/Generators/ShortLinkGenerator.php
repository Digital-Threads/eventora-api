<?php

namespace Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Generators;

use AshAllenDesign\ShortURL\Classes\Builder;

class ShortLinkGenerator
{
    public function generate(int $invitationId, int $recipientId): string
    {
        $longUrl = route('invitation.redirect', [
            'invitationId' => $invitationId,
            'recipientId' => $recipientId,
        ]);

        return $this->shortenUrl($longUrl);
    }

    protected function shortenUrl(string $longUrl): string
    {
        return app(Builder::class)->destinationUrl($longUrl)->singleUse()->make()->default_short_url;
    }
}
