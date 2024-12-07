<?php

namespace Modules\Auth\AuthEmail\Services;

use Domain\User\Repositories\UserCommandRepositoryInterface;
use Domain\User\Repositories\UserQueryRepositoryInterface;
use Modules\Auth\AuthEmail\Dto\AuthEmailForgetDto;
use Modules\Auth\AuthEmail\Dto\AuthEmailSendVerificationLinkDto;
use Modules\Auth\AuthEmail\Dto\AuthEmailUpdateDto;
use Modules\Auth\AuthEmail\Dto\AuthEmailVerifyDto;
use Modules\Auth\AuthEmail\Exceptions\AuthEmailVerificationFailedException;
use Modules\Auth\AuthEmail\Mail\AuthEmailVerificationLinkMail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Infrastructure\Eloquent\Models\User;
use Infrastructure\Utils\WebUrl;

final class AuthEmailCommandService
{


    public function __construct( private readonly UserQueryRepositoryInterface $userQueryRepository, private readonly UserCommandRepositoryInterface $userCommandRepository){

    }
    public function sendVerificationLink(AuthEmailSendVerificationLinkDto $request): void
    {
        DB::transaction(static function () use ($request): void {
            $user = $this->userQueryRepository->findById($request->userId);
            $user->update([
                'email_verification_token' => Str::random(30),
            ]);

            Mail::to($user->email)->send(new AuthEmailVerificationLinkMail(
                $user->first_name,
                $user->last_name,
                WebUrl::getEmailVerificationUrl($user->email, $user->email_verification_token),
            ));

            Event::dispatch('auth_email.verification_link_sent', [$user->id]);
        });
    }

    public function verify(AuthEmailVerifyDto $request): void
    {
        DB::transaction(static function () use ($request): void {
            try {
                $user = User::query()
                    ->where('email', $request->email)
                    ->where('email_verification_token', $request->token)
                    ->firstOrFail();

                $user->update([
                    'email_verification_token' => null,
                    'email_verified_at' => now(),
                ]);

                Event::dispatch('auth_email.verified', [$user->id]);
            } catch (ModelNotFoundException) {
                throw new AuthEmailVerificationFailedException();
            }
        });
    }

    public function update(AuthEmailUpdateDto $request): void
    {
        DB::transaction(static function () use ($request): void {
            $user = User::query()->findOrFail($request->userId);

            $user->update([
                'email' => $request->email,
                'email_verification_token' => null,
                'email_verified_at' => null,
            ]);

            Event::dispatch('auth_email.updated', [$user->id]);
        });
    }

    public function forget(AuthEmailForgetDto $request): void
    {
        DB::transaction(static function () use ($request): void {
            $user = User::query()->findOrFail($request->userId);

            $user->update([
                'email' => null,
                'email_verification_token' => null,
                'email_verified_at' => null,
            ]);

            Event::dispatch('auth_email.forgot', [$user->id]);
        });
    }
}
