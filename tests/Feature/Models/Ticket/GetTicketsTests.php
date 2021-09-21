<?php
    
    namespace Fredattack\SupportTicketsNotifications\Tests\Feature\Models\Ticket;
    
    
    use Fredattack\SupportTicketsNotifications\Models\Ticket;
    use Fredattack\SupportTicketsNotifications\Tests\TestCase;
    
    class GetTicketsTests extends TestCase
    {
        /** @test */
        public function it_can_get_all_tickets ()
        {
            
            Ticket ::factory () -> count ( 20 ) -> create ();
            
             $this -> get ( '/support-tickets/ticket' )
                -> assertOk ()
                -> assertJsonCount ( 20 ,'data' );
                
            
        }
    }
