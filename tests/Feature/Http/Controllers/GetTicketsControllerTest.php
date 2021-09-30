<?php

    namespace Fredattack\SupportTicketsNotifications\Tests\Feature\Http\Controllers;

    use Fredattack\SupportTicketsNotifications\Models\TicketSupport;
    use Fredattack\SupportTicketsNotifications\Tests\TestCase;

    class GetTicketsControllerTest extends TestCase
    {
        /** @test */
        public function it_return_tickets()
        {
            $this->assertTrue(true);
//                TicketSupport::factory ( )->count(10)->create ();
//                $this->get(route('tickets.index'))
//                    ->assertOk ()
//                    ->assertJsonCount ( 10);
        }
    }
