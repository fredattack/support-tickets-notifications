<?php

    namespace Fredattack\SupportTicketsNotifications\Notification;

    use Fredattack\SupportTicketsNotifications\Models\MessageSupport;
    use Illuminate\Bus\Queueable;
    use Illuminate\Notifications\Messages\SlackMessage;
    use Illuminate\Notifications\Notification;

    class MessageSendedSlackNotification extends Notification
    {
        use Queueable;

        private $user;
        private MessageSupport $message;

        public function __construct(MessageSupport $message, $user)
        {
            $this -> user = $user;

            $this -> message = $message;
        }

        public function via($notifiable)
        {
            return [ 'slack' ];
        }

        public function toSlack($notifiable)
        {
            $url = url('/support-ticket/'.$this->message->ticket_id);

            return ( new SlackMessage() )
                ->from($this -> user -> first_name .' - ' .config('app.name'))
                -> content('New Message')
                -> attachment(function ($attachment) use ($url) {
                    $attachment -> title($this->message->ticket->title, $url)
                        -> content($this->message->text)
                        -> markdown([ 'title' , 'text' ]);
                })->info();

//
        }

        public function getMessageContent(): string
        {
            return 'nuestro primer mensaje con Slack<br/><a href="'.config('app.url').'/support-ticket/ticket/'.$this->ticket_support->id.'">See Message</a>';
        }
    }
