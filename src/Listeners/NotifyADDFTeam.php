<?php

    namespace Fredattack\SupportTicketsNotifications\Listeners;

    use Fredattack\SupportTicketsNotifications\Events\TicketCreated;
    use Fredattack\SupportTicketsNotifications\Mail\NewTicketEmail;
    use Fredattack\SupportTicketsNotifications\Notification\SlackNotification;
    use Mail;

    class NotifyADDFTeam
    {
        public function handle(TicketCreated $event)
        {
            ray('NotifyADDFTeam', $event -> ticket) -> red();
            Mail ::to('fred.moras@addf.be') -> send(new NewTicketEmail($event -> ticket));

            config('support-tickets-notifications.user_class') ::Role('super-admin')
                -> first()
                -> notify(new slackNotification($event -> ticket, \Auth::user()));
        }
    }
