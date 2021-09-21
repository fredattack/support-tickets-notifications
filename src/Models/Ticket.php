<?php
    
    
    namespace Fredattack\SupportTicketsNotifications\Models;
    
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;


    class Ticket extends Model
    {
       use hasFactory;
        protected $guarded =[];
    
        public function messages (  )
        {
            return $this->hasMany ( Message::class);
        }
    }
