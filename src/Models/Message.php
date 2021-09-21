<?php
    
    
    namespace Fredattack\SupportTicketsNotifications\Models;
    
    
    use Illuminate\Database\Eloquent\Model;

    class Message extends Model
    {
        protected $guarded =[];
    
        public function ticket (  )
        {
            return $this->belongsTo ( Ticket::class);
        }
    }
