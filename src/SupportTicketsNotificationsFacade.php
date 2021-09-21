<?php

namespace Fredattack\SupportTicketsNotifications;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Fredattack\SupportTicketsNotifications\SupportTicketsNotifications
 */
class SupportTicketsNotificationsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'support-tickets-notifications';
    }
}
