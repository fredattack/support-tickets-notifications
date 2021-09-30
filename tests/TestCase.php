<?php

namespace Fredattack\SupportTicketsNotifications\Tests;

use Fredattack\SupportTicketsNotifications\SupportTicketsNotificationsServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Route;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
        Route::sutino('support-tickets');

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Fredattack\\SupportTicketsNotifications\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            SupportTicketsNotificationsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');


        $migration = include __DIR__.'/../database/migrations/create_support-tickets-notifications_table.php.stub';
        $migration->up();
    }
}
