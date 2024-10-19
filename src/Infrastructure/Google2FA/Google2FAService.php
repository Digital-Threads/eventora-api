<?php

namespace Infrastructure\Google2FA;

interface Google2FAService
{
    /**
     * Generate Google2FA secret key.
     */
    public function generateSecretKey(): string;

    /**
     * Generate Google2FA recovery code.
     */
    public function generateRecoveryCode(): string;

    /**
     * Get QR code using against the secret key.
     */
    public function getQRCode(string $holder, string $secretKey): string;

    /**
     * Verify key against the secret key.
     */
    public function verifyKey(string $secretKey, string $key): bool;
}
