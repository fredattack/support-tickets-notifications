<?php
    
    
    namespace Fredattack\SupportTicketsNotifications\Http\Controllers;
    
    
    use Fredattack\SupportTicketsNotifications\Models\Ticket;
    use Illuminate\Routing\Controller;

    class GetTicketsController extends Controller
    {
       public function __invoke ()
       {
           
           return \Response::json ( ['data'=>Ticket ::with('messages')->get ()] );
       }
    }
