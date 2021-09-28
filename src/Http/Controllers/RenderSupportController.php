<?php

    namespace Fredattack\SupportTicketsNotifications\Http\Controllers;

    class RenderSupportController
    {
        public function __invoke()
        {
            return view('support-tickets-notifications::support_index');
        }
    }
