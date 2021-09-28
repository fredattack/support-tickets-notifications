<?php

    namespace Fredattack\SupportTicketsNotifications\Tests\Feature\Http\Controllers;

    use Fredattack\SupportTicketsNotifications\Models\Ticket;
    use Fredattack\SupportTicketsNotifications\Tests\TestCase;

    class GetTicketsControllerTest extends TestCase
    {
        /** @test */
        public function it_return_tickets()
        {
            Ticket::factory()->count(10)->create();
            $this->get(route('tickets.index'))
                    ->assertOk()
                    ->assertJsonCount(10);
        }
    }
