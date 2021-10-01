<?php

    namespace Fredattack\SupportTicketsNotifications\Http\Controllers;

    use Fredattack\SupportTicketsNotifications\Events\TicketCreated;
    use Fredattack\SupportTicketsNotifications\Http\FormRequest\StoreTicketRequest;
    use Fredattack\SupportTicketsNotifications\Models\TicketSupport;
    use Illuminate\Routing\Controller;

    class StoreTicketController extends Controller
    {
        public function __invoke(StoreTicketRequest $request)
        {
            $validated_request = $request -> validated();

            $ticket = TicketSupport ::create($validated_request);

            if ($request -> has('attachments')) {
                foreach ($request -> attachments as $file) {
                    $ticket -> addMediaFromBase64($file[ 'base64' ])
                            -> usingName(str_replace('', '', $file[ 'name' ]))
                            -> toMediaCollection('attachments');
                }
            }
            event(new TicketCreated($ticket));

            return \Response ::json([ 'data' => $ticket -> load([ 'author' , 'messages' , 'messages.author' ]) ], 201);
        }
    }
