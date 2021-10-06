<?php

    namespace Fredattack\SupportTicketsNotifications\Mail;

    use Fredattack\SupportTicketsNotifications\Models\TicketSupport;
    use Illuminate\Mail\Mailable;

    class NewTicketEmail extends mailable
    {
        private TicketSupport $ticket;

        public function __construct(TicketSupport $ticket)
        {
            ray('NewTicketEmail');
            $this -> ticket = $ticket;
        }

        public function build()
        {
            return $this -> markdown('support-tickets-notifications::emails.newTicketMail')
                -> with([ 'ticket' => $this -> ticket ])
                -> subject('Nouveau ticket de '.Auth()->user() -> first_name .' - ' .config('app.name'));
        }
    }
