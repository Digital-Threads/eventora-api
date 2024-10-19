<?php

namespace Modules\OAuth\Enums;

enum SocialProviderEnum: string
{
    case FACEBOOK = 'facebook';
    case GOOGLE = 'google';

    // Добавьте другие провайдеры по мере необходимости

    public function getDisplayName(): string
    {
        return match ($this) {
            self::FACEBOOK => 'Facebook',
            self::GOOGLE => 'Google',
            // Добавьте другие отображаемые имена по мере необходимости
        };
    }
}
