<?php
    
    
    namespace Fredattack\SupportTicketsNotifications\Http\Controllers;
    
    
    use Illuminate\Support\Facades\Auth;

    class RenderSupportController
    {
        public function __invoke ()
        {
           
            return view ('support-tickets-notifications::support_index');
        }
    }
