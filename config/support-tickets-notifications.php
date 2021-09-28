<?php
// config for Fredattack/SupportTicketsNotifications
    return [
        "default_channel" => env ( 'DEFAULT_SUPPORT_NOTIFICATION_CHANNEL' , 'slack' ) ,
        "user_class" => 'App\Models\User' ,
    ];
