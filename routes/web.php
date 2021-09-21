<?php
    
    use Fredattack\SupportTicketsNotifications\Http\Controllers\GetTicketsController;
    use Fredattack\SupportTicketsNotifications\Http\Controllers\RenderSupportController;
    use Illuminate\Support\Facades\Route;
    
    Route ::macro ( 'sutino' , function ( $prefix ) {
        Route ::prefix ( $prefix )->middleware ( "auth")-> group ( function () {
            Route ::get ( '/' , RenderSupportController::class );
            
            Route ::get ( '/ticket' , GetTicketsController::class );
            
        } );
    } );
