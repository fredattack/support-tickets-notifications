<?php

    namespace Fredattack\SupportTicketsNotifications\Notification;

    use Fredattack\SupportTicketsNotifications\Models\TicketSupport;
    use Illuminate\Bus\Queueable;
    use Illuminate\Notifications\Messages\SlackMessage;
    use Illuminate\Notifications\Notification;

    class NewTicketSlackNotification extends Notification
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
//            return ( new SlackMessage() )
//                -> content ( $this -> getMessageContent () )
//                ->warning ()
//                ->from ( $this -> user -> full_name);
            $url = url('/support-ticket/'.$this->ticket_support->id);

            return ( new SlackMessage() )
                ->from($this -> user -> first_name .' - ' .config('app.name'))
                -> content('New Ticket Created !!!')
                -> attachment(function ($attachment) use ($url) {
                    $attachment -> title($this->ticket_support->title, $url)
                        -> content($this->ticket_support->description)
                        -> markdown([ 'title' , 'text' ]);
                })->info();

//            if($this->ticket_support->type ==='fixe') {
//                return $slack_message -> error () ();
//            }
//            if($this->ticket_support->type ==='help') {
//                return $slack_message -> warning () ();
//            }
//            return $slack_message ->info();
        }

        public function getMessageContent(): string
        {
            return 'nuestro primer mensaje con Slack<br/><a href="'.config('app.url').'/support-ticket/ticket/'.$this->ticket_support->id.'">See Message</a>';
        }
    }
