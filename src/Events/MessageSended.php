<?php

    namespace Fredattack\SupportTicketsNotifications\Events;

    use Fredattack\SupportTicketsNotifications\Models\MessageSupport;
    use Fredattack\SupportTicketsNotifications\Models\TicketSupport;
    use Illuminate\Foundation\Events\Dispatchable;
    use Illuminate\Queue\SerializesModels;

    class MessageSended
    {
        use Dispatchable;
        use SerializesModels;
    
        public MessageSupport $message;
    
        public function __construct( MessageSupport $message)
        {
            $this -> message = $message;
        }
    }
