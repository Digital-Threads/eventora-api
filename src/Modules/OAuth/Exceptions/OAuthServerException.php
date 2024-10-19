<?php

namespace Modules\OAuth\Exceptions;


use League\OAuth2\Server\Exception\OAuthServerException as Exception;

final class OAuthServerException extends Exception
{
    public static function invalidOtp(): static
    {
        return new static(
            'OTP code is missing or incorrect.',
            3,
            'invalid_otp',
            400,
            'Make sure to provide correct one time password',
        );
    }

    public static function invalidOtpRecoveryCode(): static
    {
        return new static(
            'OTP recovery code is incorrect.',
            3,
            'invalid_otp_recovery_code',
            400,
            'Make sure to provide correct one time password recovery code',
        );
    }

    public static function invalidSignupCredentials(string $message = null): static
    {
        return new static(
            $message ?? 'The signup credentials are already associated with an account.',
            6,
            'invalid_grant',
            400
        );
    }

    public static function googleSignupFailed(): static
    {
        return new static(
            'Google signup failed. Please try again later.',
            7,
            'google_signup_failed',
            400,
            'Ensure that the provided Google credentials are valid.'
        );
    }

    public static function facebookSignupFailed(): static
    {
        return new static(
            'Facebook signup failed. Please try again later.',
            8,
            'facebook_signup_failed',
            400,
            'Ensure that the provided Facebook credentials are valid.'
        );
    }
}
