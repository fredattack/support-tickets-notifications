<?php

    namespace Fredattack\SupportTicketsNotifications;

    use Fredattack\SupportTicketsNotifications\Events\MessageSended;
    use Fredattack\SupportTicketsNotifications\Events\TicketCreated;
    use Fredattack\SupportTicketsNotifications\Listeners\NotifyADDFTeam;
    use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

    class EventServiceProvider extends ServiceProvider
    {
        protected $listen = [
            TicketCreated::class => [
                NotifyADDFTeam::class ,
            ],
            MessageSended::class => [
                NotifyADDFTeam::class ,
            ],
        ];

        /**
         * Register any events for your application.
         *
         * @return void
         */
        public function boot(): void
        {
            parent::boot();
        }
    }
