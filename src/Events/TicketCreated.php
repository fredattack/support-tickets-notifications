<?php
    namespace Fredattack\SupportTicketsNotifications\Events;
    
    use Fredattack\SupportTicketsNotifications\Models\TicketSupport;
    use Illuminate\Foundation\Events\Dispatchable;
    use Illuminate\Queue\SerializesModels;

    class TicketCreated
    {
        use Dispatchable, SerializesModels;
        public TicketSupport $ticket;
    
        public function __construct ( TicketSupport $ticket) {
            $this -> ticket = $ticket;
        }
    }
