<?php
    
    use Fredattack\SupportTicketsNotifications\Http\Controllers\GetTicketController;
    use Fredattack\SupportTicketsNotifications\Http\Controllers\GetTicketListController;
    use Fredattack\SupportTicketsNotifications\Http\Controllers\RenderSupportController;
    use Fredattack\SupportTicketsNotifications\Http\Controllers\StoreMessageController;
    use Fredattack\SupportTicketsNotifications\Http\Controllers\StoreTicketController;
    use Illuminate\Support\Facades\Route;
    
    Route ::macro ( 'sutino' , function ( $prefix ) {
        Route ::prefix ( $prefix )->middleware ( "auth")-> group ( function () {
            Route ::get ( '/{name?}' , RenderSupportController::class )->where('name', '[\/\w\.-]*');
        } );
        Route ::prefix ( 'api' )->middleware ( "auth")-> group ( function () {
            Route ::get ( '/ticket' , GetTicketListController::class );
            Route ::post ( '/ticket' , StoreTicketController::class );
            Route ::post ( '/message/{ticket}' , StoreMessageController::class );
            Route ::get ( '/ticket/{ticket}' , GetTicketController::class );
        } );
    } );
