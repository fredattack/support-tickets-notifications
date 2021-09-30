<?php

    namespace Fredattack\SupportTicketsNotifications\Http\Controllers;

    use Fredattack\SupportTicketsNotifications\Http\FormRequest\StoreMessageRequest;
    use Fredattack\SupportTicketsNotifications\Models\MessageSupport;
    use Illuminate\Routing\Controller;

    class StoreMessageController extends Controller
    {
        public function __invoke(StoreMessageRequest $request, $ticket_id)
        {
            $validated_request = $request -> validated();

            $validated_request[ 'ticket_id' ] = $ticket_id;

            $message = MessageSupport ::create($validated_request);

            if ($request -> has('attachments')) {
                foreach ($request -> attachments as $file) {
                    $message -> addMediaFromBase64($file[ 'base64' ])
                        -> usingName(str_replace('', '', $file[ 'name' ]))
                        -> toMediaCollection('attachments');
                }
            }


            return \Response ::json([ 'data' => $message ], 201);
        }
    }
