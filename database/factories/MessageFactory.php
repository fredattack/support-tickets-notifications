<?php
    
    namespace Fredattack\SupportTicketsNotifications\Database\Factories;
    
    use Fredattack\SupportTicketsNotifications\Models\Message;
    use Fredattack\SupportTicketsNotifications\Models\Ticket;
    use Illuminate\Database\Eloquent\Factories\Factory;
    
    
    class MessageFactory extends Factory
    {
        protected $model = Message::class;
        
        public function definition ()
        {
            return [
                'text' => $this -> faker ->paragraph (3),
                'read' => $this->faker->boolean(85) ,
                'user_id' => $this->faker->numberBetween (1,10) ,
                'ticket_id' => Ticket::factory()->create()->id ,
            ];
        }
    }

