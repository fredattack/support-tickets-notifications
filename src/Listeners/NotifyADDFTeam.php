<?php
    
    
    namespace Fredattack\SupportTicketsNotifications\Listeners;
    
    
    use Fredattack\SupportTicketsNotifications\Events\MessageSended;
    use Fredattack\SupportTicketsNotifications\Events\TicketCreated;
    use Fredattack\SupportTicketsNotifications\Mail\NewTicketEmail;
    use Fredattack\SupportTicketsNotifications\Notification\MessageSendedSlackNotification;
    use Fredattack\SupportTicketsNotifications\Notification\NewTicketSlackNotification;
    use Mail;
    
    class NotifyADDFTeam
    {
        public function handle ( $event )
        {
            if($event instanceof TicketCreated){
            
            $this -> sendEmailForNewTicket ( $event );
            $this -> SendSlackForNewTicket ( $event );
            }
            if($event instanceof MessageSended){
             $this->SendSlackForNewMessage($event);
            }
            
        }
        
        public function sendEmailForNewTicket ( TicketCreated $event ) : void
        {
            if ( in_array ( $event -> ticket -> type , config ( 'support-tickets-notifications.send_email_for_type' ) ) ) {
                $list_mail = array_filter ( config  ( 'support-tickets-notifications.send_email_to' ),function ($email){
                    return filter_var ( $email,FILTER_VALIDATE_EMAIL);
                }) ;
                Mail ::to ( $list_mail )  -> send ( new NewTicketEmail( $event -> ticket ) );
            }
        }
        
        public function SendSlackForNewTicket ( TicketCreated $event ) : void
        {
            if ( in_array ( $event -> ticket -> type , config ( 'support-tickets-notifications.send_slack_for_type' ) ) ) {
                config ( 'support-tickets-notifications.user_class' ) ::Role ( 'super-admin' )
                    -> first ()
                    -> notify ( new NewTicketSlackNotification( $event -> ticket , \Auth ::user () ) );
            }
        }
        public function SendSlackForNewMessage ( MessageSended $event ) : void
        {
           
                config ( 'support-tickets-notifications.user_class' ) ::Role ( 'super-admin' )
                    -> first ()
                    -> notify ( new MessageSendedSlackNotification( $event -> message , \Auth ::user () ) );
        }
    }
