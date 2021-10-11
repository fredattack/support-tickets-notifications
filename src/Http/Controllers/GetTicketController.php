<?php
    
    namespace Fredattack\SupportTicketsNotifications\Http\Controllers;
    
    use Fredattack\SupportTicketsNotifications\Models\TicketSupport;
    use Illuminate\Routing\Controller;
    
    class GetTicketController extends Controller
    {
        public function __invoke ( TicketSupport $ticket )
        {
            $this -> setTicketInProgress ( $ticket );
            
            $this -> markTicketRead ( $ticket );
            
            $ticket -> load ( [ 'author' , 'messages' , 'messages.author' , 'messages.readers' , 'messages.media' , 'media' ] );
            
            $this -> markMessagesRead ( $ticket );
            
            $ticket = $this -> isMessagesReaded ( $ticket );
            
            ray ( $ticket -> messages );
            
            return \Response ::json ( [ 'ticket' => $ticket , 'auth' => \Auth ::user () ] );
        }
        
        public function setTicketInProgress ( TicketSupport $ticket ) : void
        {
            if ( \Auth ::user () -> hasRole ( 'super-admin' ) && $ticket -> status === 'open' ) {
                $ticket -> update ( [ 'status' => 'in progress' ] );
            }
        }
        
        public function markTicketRead ( TicketSupport $ticket ) : void
        {
            $ticket -> readers () -> syncWithoutDetaching ( [ \Auth ::id () ] );
        }
        
        public function markMessagesRead ( TicketSupport $ticket ) : void
        {
            $ticket -> messages () -> each ( fn ( $message ) => $message -> readers () -> syncWithoutDetaching ( [ \Auth ::id () ] ) );
        }
        
        public function isMessagesReaded ( TicketSupport $ticket )
        {
            ray () -> clearScreen ();
            
            $ticket -> messages () -> each ( function ( $message ) use ($ticket) {
              
                if ( $message -> author -> hasRole ( 'super-admin' ) ) {
                    
                    $is_read_by_ticket_author = $message -> readers
                            -> where ( 'pivot.user_id' , $ticket -> author_id )
                            -> count () > 0;

                    $message -> read = $is_read_by_ticket_author;
                  
                } else {
                    $is_read_by_ADDF = $message -> readers
                        -> filter ( fn ( $user ) => $user -> hasRole ( 'super-admin' ) )
                        -> count ();
                    
                    $message -> read = $is_read_by_ADDF;
                }
                
                    $message -> save ();
            });
            return $ticket;
        }
    }
