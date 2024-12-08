<?php

namespace Infrastructure\Eloquent;


use Domain\Company\Repositories\CompanyCommandRepositoryInterface;
use Domain\Company\Repositories\CompanyQueryRepositoryInterface;
use Domain\Event\Repositories\EventCommandRepositoryInterface;
use Domain\Event\Repositories\EventQueryRepositoryInterface;
use Domain\Invitation\Repositories\InvitationCommandRepositoryInterface;
use Domain\Invitation\Repositories\InvitationQueryRepositoryInterface;
use Domain\InvitationDelivery\Repositories\InvitationDeliveryCommandRepositoryInterface;
use Domain\InvitationDelivery\Repositories\InvitationDeliveryQueryRepositoryInterface;
use Domain\Role\Repositories\RoleQueryRepositoryInterface;
use Domain\SocialProvider\Repositories\SocialProviderCommandRepositoryInterface;
use Domain\SocialProvider\Repositories\SocialProviderQueryRepositoryInterface;
use Domain\Tag\Repositories\TagCommandRepositoryInterface;
use Domain\Tag\Repositories\TagQueryRepositoryInterface;
use Domain\Ticket\Repositories\TicketCommandRepositoryInterface;
use Domain\Ticket\Repositories\TicketQueryRepositoryInterface;
use Domain\User\Repositories\UserCommandRepositoryInterface;
use Domain\User\Repositories\UserQueryRepositoryInterface;
use Infrastructure\Eloquent\Repositories\Company\EloquentCompanyCommandRepository;
use Infrastructure\Eloquent\Repositories\Company\EloquentCompanyQueryRepository;
use Infrastructure\Eloquent\Repositories\Event\EloquentEventCommandRepository;
use Infrastructure\Eloquent\Repositories\Event\EloquentEventQueryRepository;
use Infrastructure\Eloquent\Repositories\Invitation\EloquentInvitationCommandRepository;
use Infrastructure\Eloquent\Repositories\Invitation\EloquentInvitationQueryRepository;
use Infrastructure\Eloquent\Repositories\InvitationDelivery\EloquentInvitationDeliveryCommandRepository;
use Infrastructure\Eloquent\Repositories\InvitationDelivery\EloquentInvitationDeliveryQueryRepository;
use Infrastructure\Eloquent\Repositories\SocialProvider\EloquentSocialProviderCommandRepository;
use Infrastructure\Eloquent\Repositories\SocialProvider\EloquentSocialProviderQueryRepository;
use Infrastructure\Eloquent\Repositories\Tag\EloquentTagCommandRepository;
use Infrastructure\Eloquent\Repositories\Tag\EloquentTagQueryRepository;
use Infrastructure\Eloquent\Repositories\Ticket\EloquentTicketCommandRepository;
use Infrastructure\Eloquent\Repositories\Ticket\EloquentTicketQueryRepository;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Infrastructure\Eloquent\Repositories\Role\EloquentRoleQueryRepository;
use Infrastructure\Eloquent\Repositories\User\EloquentUserCommandRepository;
use Infrastructure\Eloquent\Repositories\User\EloquentUserQueryRepository;

final class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        Factory::guessFactoryNamesUsing(static fn($name) => 'Database\\Factories\\' . class_basename($name) . 'Factory');
        Factory::guessModelNamesUsing(static fn($name) => 'Infrastructure\\Eloquent\\Models\\' . str($name::class)->classBasename()->beforeLast('Factory'));

        $this->app->bind(EventQueryRepositoryInterface::class, EloquentEventQueryRepository::class);
        $this->app->bind(EventCommandRepositoryInterface::class, EloquentEventCommandRepository::class);

        $this->app->bind(CompanyCommandRepositoryInterface::class, EloquentCompanyCommandRepository::class);
        $this->app->bind(CompanyQueryRepositoryInterface::class, EloquentCompanyQueryRepository::class);

        $this->app->bind(InvitationCommandRepositoryInterface::class, EloquentInvitationCommandRepository::class);
        $this->app->bind(InvitationQueryRepositoryInterface::class, EloquentInvitationQueryRepository::class);

        $this->app->bind(InvitationDeliveryCommandRepositoryInterface::class, EloquentInvitationDeliveryCommandRepository::class);
        $this->app->bind(InvitationDeliveryQueryRepositoryInterface::class, EloquentInvitationDeliveryQueryRepository::class);

        $this->app->bind(TagCommandRepositoryInterface::class, EloquentTagCommandRepository::class);
        $this->app->bind(TagQueryRepositoryInterface::class, EloquentTagQueryRepository::class);
        $this->app->bind(TicketCommandRepositoryInterface::class, EloquentTicketCommandRepository::class);
        $this->app->bind(TicketQueryRepositoryInterface::class, EloquentTicketQueryRepository::class);
        $this->app->bind(UserCommandRepositoryInterface::class, EloquentUserCommandRepository::class);
        $this->app->bind(UserQueryRepositoryInterface::class, EloquentUserQueryRepository::class);
        $this->app->bind(RoleQueryRepositoryInterface::class, EloquentRoleQueryRepository::class);
        $this->app->bind(SocialProviderCommandRepositoryInterface::class, EloquentSocialProviderCommandRepository::class);
        $this->app->bind(SocialProviderQueryRepositoryInterface::class, EloquentSocialProviderQueryRepository::class);


    }
}
