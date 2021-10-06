
@component('mail::message')
# {{$ticket->title}}

{{$ticket->description}}


@component('mail::button', ['url' => url('/support-ticket/'.$ticket->id)])
    Ticket
@endcomponent


@endcomponent
