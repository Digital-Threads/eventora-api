<?php

namespace Modules\Invitation\InvitationDelivery\Generators;

use AshAllenDesign\ShortURL\Classes\Builder;

// Если используем библиотеку для сокращения ссылок

class ShortLinkGenerator
{
    public function generate(string $invitationId, string $recipientId): string
    {
        // Базовая ссылка, куда будут перенаправлены пользователи
        $longUrl = route('invitation.redirect', [
            'invitationId' => $invitationId,
            'recipientId' => $recipientId,
        ]);

        // Создание короткой ссылки
        return $this->shortenUrl($longUrl);
    }

    protected function shortenUrl(string $longUrl): string
    {
        // Используем библиотеку для сокращения ссылок
        $shortURL = new Builder();
        return $shortURL->destinationUrl($longUrl)->make()->default_short_url;
    }
}
