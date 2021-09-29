<?php
    
    
    namespace Fredattack\SupportTicketsNotifications\Http\Controllers;
    
    
    use Fredattack\SupportTicketsNotifications\Models\TicketSupport;
    use Illuminate\Routing\Controller;
    
    class SetTicketClosedController extends Controller
    {
        public function __invoke ( TicketSupport $ticket )
        {
            $ticket -> update ( [ 'status' => 'closed' ] );
            
            return \Response ::json ( [ 'data' => $ticket ] );
        }
        
        
    }
