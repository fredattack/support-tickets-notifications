<?php

namespace Fredattack\SupportTicketsNotifications\Commands;

use Illuminate\Console\Command;

class SupportTicketsNotificationsCommand extends Command
{
    public $signature = 'support-tickets-notifications';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
