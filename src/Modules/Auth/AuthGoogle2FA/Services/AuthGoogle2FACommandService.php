<?php

namespace Modules\Auth\AuthGoogle2FA\Services;

use Domain\User\Repositories\UserCommandRepositoryInterface;
use Domain\User\Repositories\UserQueryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Infrastructure\Google2FA\Google2FAService;
use Modules\Auth\AuthGoogle2FA\Dto\AuthGoogle2FACredentialsDto;
use Modules\Auth\AuthGoogle2FA\Dto\AuthGoogle2FADisableDto;
use Modules\Auth\AuthGoogle2FA\Dto\AuthGoogle2FAEnableDto;
use Modules\Auth\AuthGoogle2FA\Dto\AuthGoogle2FAForgetDto;
use Modules\Auth\AuthGoogle2FA\Dto\AuthGoogle2FAIssueDto;
use Modules\Auth\AuthGoogle2FA\Dto\AuthGoogle2FAReissueDto;

final class AuthGoogle2FACommandService
{
    public function __construct(
        private readonly Google2FAService $tfa,
        private readonly UserQueryRepositoryInterface $userQueryRepository,
        private readonly UserCommandRepositoryInterface $userCommandRepository,
    ) {}

    public function issue(AuthGoogle2FAIssueDto $request): AuthGoogle2FACredentialsDto
    {
        return DB::transaction(function () use ($request): AuthGoogle2FACredentialsDto {
            $user = $this->userQueryRepository->findById($request->userId);
            if (!$user) {
                throw new \Exception("User not found.");
            }

            $secret = $this->tfa->generateSecretKey();

            $credentials = new AuthGoogle2FACredentialsDto(
                $this->tfa->getQRCode($user->email, $secret),
                $secret,
                $this->tfa->generateRecoveryCode(),
            );

            $this->userCommandRepository->update($user->id, [
                'google_2fa_secret' => $secret,
                'google_2fa_recovery_code' => $credentials->recoveryCode,
            ]);

            Event::dispatch('auth_google2fa.issued', [$user->id]);

            return $credentials;
        });
    }

    public function reissue(AuthGoogle2FAReissueDto $request): AuthGoogle2FACredentialsDto
    {
        return DB::transaction(function () use ($request): AuthGoogle2FACredentialsDto {
            $user = $this->userQueryRepository->findById($request->userId);

            $credentials = new AuthGoogle2FACredentialsDto(
                $this->tfa->getQRCode($user->email, $user->google_2fa_secret),
                $user->google_2fa_secret,
                $user->google_2fa_recovery_code,
            );

            Event::dispatch('auth_google2fa.reissued', [$user->id]);

            return $credentials;
        });
    }

    public function enable(AuthGoogle2FAEnableDto $request): void
    {
        DB::transaction(function () use ($request): void {
            $user = $this->userQueryRepository->findById($request->userId);

            $this->userCommandRepository->update($user->id, [
                'google_2fa_enabled' => true,
            ]);

            if ($request->trusted) {
                Event::dispatch('auth_trusted_device.create', [
                    [
                        'userId' => $user->id,
                        'ip' => $request->ip,
                        'userAgent' => $request->userAgent,
                                                               ]
                ]);
            }

            Event::dispatch('auth_google2fa.enabled', [$user->id]);
        });
    }

    public function disable(AuthGoogle2FADisableDto $request): void
    {
        DB::transaction(function () use ($request): void {
            $user = $this->userQueryRepository->findById($request->userId);

            $this->userCommandRepository->update($user->id, [
                'google_2fa_enabled' => false,
            ]);

            Event::dispatch('auth_google2fa.disabled', [$user->id]);
        });
    }

    public function forget(AuthGoogle2FAForgetDto $request): void
    {
        DB::transaction(function () use ($request): void {
            $user = $this->userQueryRepository->findById($request->userId);

            $this->userCommandRepository->update($user->id, [
                'google_2fa_secret' => null,
                'google_2fa_recovery_code' => null,
            ]);

            Event::dispatch('auth_google2fa.forgot', [$user->id]);
        });
    }
}
