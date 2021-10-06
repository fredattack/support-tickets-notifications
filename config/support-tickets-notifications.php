<?php
// config for Fredattack/SupportTicketsNotifications
    return [
        "user_class" => 'App\Models\User' ,
        "send_email_for_type" => !is_null(env ( 'SUPPORT_NOTIFICATION_EMAIL_TYPE' )) ?  explode ( ',' , env ( 'SUPPORT_NOTIFICATION_EMAIL_TYPE' ) )  : [ 'fixe' , 'help' , 'feature' ] ,
        "send_email_to" => !is_null(env ( 'ADDF_SUPPORT_NOTIFICATION_EMAIL_TO' )) ? explode ( ',' , env ( 'ADDF_SUPPORT_NOTIFICATION_EMAIL_TO' ) ) : [] ,
        "send_slack_for_type" => !is_null(env ( 'SUPPORT_NOTIFICATION_SLACK_TYPE' )) ?  explode ( ',' , env ( 'SUPPORT_NOTIFICATION_SLACK_TYPE' ) )  : [ 'fixe' , 'help' , 'feature' ] ,
        "slack_channel" => env ( 'ADDF_SUPPORT_NOTIFICATION_SLACK_CHANNEL' , '' ) ,
    ];
