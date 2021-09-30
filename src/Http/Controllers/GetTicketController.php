<?php

    namespace Fredattack\SupportTicketsNotifications\Http\Controllers;

    use Fredattack\SupportTicketsNotifications\Models\TicketSupport;
    use Illuminate\Routing\Controller;

    class GetTicketController extends Controller
    {
        public function __invoke(TicketSupport $ticket)
        {
            $this -> setTicketInProgress($ticket);

            $this -> markTicketRead($ticket);

            $ticket->load(['author','messages','messages.author','messages.media','media']);

            $this -> markMessagesRead($ticket);

            return \Response::json(['ticket' => $ticket,'auth' => \Auth::user()]);
        }

        public function setTicketInProgress(TicketSupport $ticket): void
        {
            if (\Auth ::user() -> hasRole('super-admin') && $ticket -> status === 'open') {
                $ticket -> update([ 'status' => 'in progress' ]);
            }
        }

        public function markTicketRead(TicketSupport $ticket): void
        {
            $ticket -> readers() -> syncWithoutDetaching([ \Auth ::id() ]);
        }

        public function markMessagesRead(TicketSupport $ticket): void
        {
            $ticket -> messages() -> each(fn ($message) => $message -> readers() -> syncWithoutDetaching([ \Auth ::id() ]));
        }
    }
