<?php
    
    
    namespace Fredattack\SupportTicketsNotifications\Http\Controllers;
    
    
    use Fredattack\SupportTicketsNotifications\Models\TicketSupport;
    use Illuminate\Routing\Controller;

    class GetTicketListController extends Controller
    {
       public function __invoke ()
       {
    
           $collection = TicketSupport::with(['messages','author'])
               ->when(request('active') === 'true',fn ($q)=> $q->where('status','open'))
               ->when(request('active') !== 'true',fn ($q)=> $q->where('status','closed'))
               ->latest ('updated_at')
               -> get ();
           
           return \Response::json ( ['data'=> $collection ] );
       }
    }
