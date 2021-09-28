<?php

    namespace Fredattack\SupportTicketsNotifications\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Spatie\MediaLibrary\HasMedia;
    use Spatie\MediaLibrary\InteractsWithMedia;

    class TicketSupport extends Model implements HasMedia
    {
        use InteractsWithMedia;
        use hasFactory;

        protected $guarded = [];
        protected $casts = [
            'created_at' => 'datetime:d M H:i',
        ];

        public function messages()
        {
            return $this->hasMany(MessageSupport::class, 'ticket_id', 'id');
        }

        public function author()
        {
            return $this->belongsTo(config('support-tickets-notifications.user_class'));
        }

        public function readers()
        {
            return $this->belongsToMany(config('support-tickets-notifications.user_class'), 'tickets_readers')->withTimestamps();
        }
    }
