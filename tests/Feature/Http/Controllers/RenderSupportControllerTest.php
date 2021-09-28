<?php

    namespace Fredattack\SupportTicketsNotifications\Tests\Feature\Http\Controllers;

    use Fredattack\SupportTicketsNotifications\Tests\TestCase;

    class RenderSupportControllerTest extends TestCase
    {
        /** @test */
        public function it_can_render_ok()
        {
            $this->get('/support-tickets')
                ->assertOk()
                ->assertSee('hello packages');
        }
    }
