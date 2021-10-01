<?php

    namespace Fredattack\SupportTicketsNotifications\Notification;

    use Fredattack\SupportTicketsNotifications\Models\TicketSupport;
    use Illuminate\Bus\Queueable;
    use Illuminate\Notifications\Messages\SlackMessage;
    use Illuminate\Notifications\Notification;

    class SlackNotification extends Notification
    {
        use Queueable;

        private $user;
        private TicketSupport $ticket_support;

        public function __construct(TicketSupport $ticket_support, $user)
        {
            $this -> user = $user;
            $this -> ticket_support = $ticket_support;
        }

        public function via($notifiable)
        {
            return [ 'slack' ];
        }

        public function toSlack($notifiable)
        {
            return ( new SlackMessage() )
                -> content($this -> getMessageContent())
                ->warning()
                ->from($this -> user -> full_name);
        }

        public function getMessageContent(): string
        {
            return 'nuestro primer mensaje con Slack<br/><a href="'.config('app.url').'/support-ticket/ticket/'.$this->ticket_support->id.'">See Message</a>';
        }
    }
