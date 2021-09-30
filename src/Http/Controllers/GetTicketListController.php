<?php

    namespace Fredattack\SupportTicketsNotifications\Http\Controllers;

    use Fredattack\SupportTicketsNotifications\Models\TicketSupport;
    use Illuminate\Routing\Controller;

    class GetTicketListController extends Controller
    {
        public function __invoke()
        {
            $collection = TicketSupport::with(['messages','author'])
               ->when(request('active') === 'true', fn ($q) => $q->whereIn('status', ['open','in progress']))
               ->when(request('active') !== 'true', fn ($q) => $q->where('status', 'closed'))
               ->latest('updated_at')
               -> get();

            return \Response::json(['tickets' => $collection,'auth' => \Auth::user()]);
        }
    }
