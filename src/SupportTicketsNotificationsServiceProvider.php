<?php

namespace Fredattack\SupportTicketsNotifications;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Fredattack\SupportTicketsNotifications\Commands\SupportTicketsNotificationsCommand;

class SupportTicketsNotificationsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('support-tickets-notifications')
            ->hasConfigFile()
            ->hasViews()
            ->hasAssets()
            ->hasRoute('web')
            ->hasMigration('create_support-tickets-notifications_table')
            ->hasCommand(SupportTicketsNotificationsCommand::class);
    }
}
