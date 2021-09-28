<?php

    namespace Fredattack\SupportTicketsNotifications\Http\Controllers;

    use Fredattack\SupportTicketsNotifications\Models\TicketSupport;
    use Illuminate\Routing\Controller;

    class GetTicketController extends Controller
    {
        public function __invoke(TicketSupport $ticket)
        {
            $ticket->load(['author','messages','messages.author','messages.media','media']);

            $ticket->readers()->syncWithoutDetaching([\Auth::id()]);
            $ticket->messages()->each(fn ($message) => $message->readers()->syncWithoutDetaching([\Auth::id()]));
//           ray($ticket->getMedia ('attachment')[0]->getFullUrl());
            return \Response::json(['data' => $ticket]);
        }
    }
