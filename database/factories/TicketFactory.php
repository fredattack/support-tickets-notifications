<?php
    
    namespace Fredattack\SupportTicketsNotifications\Database\Factories;
    
    use Fredattack\SupportTicketsNotifications\Models\Ticket;
    use Illuminate\Database\Eloquent\Factories\Factory;
    
    
    class TicketFactory extends Factory
    {
        protected $model = Ticket::class;
        
        public function definition ()
        {
            return [
                'title' => $this->faker->sentence (6) ,
                'description' => $this->faker->paragraph(2),
                'public' => $this->faker->boolean(75) ,
                'priority' => $this->faker->numberBetween (1,5) ,
                'type' => $this->faker->randomElement([ 'fixe' , 'help' , 'feature' ]) ,
                'status' => $this->faker->randomElement([ 'open' , 'closed']) ,
                'user_id' => $this->faker->numberBetween (1,10) ,
            ];
        }
    }

