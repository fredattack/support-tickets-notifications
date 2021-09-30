<?php

    namespace Fredattack\SupportTicketsNotifications\Models;

    use Illuminate\Database\Eloquent\Model;
    use Spatie\MediaLibrary\HasMedia;
    use Spatie\MediaLibrary\InteractsWithMedia;

    class MessageSupport extends Model implements HasMedia
    {
        use InteractsWithMedia;

        protected $guarded = [];

        protected $casts = [
            'created_at' => 'datetime:d M H:i',
        ];

        public function ticket()
        {
            return $this->belongsTo(TicketSupport::class);
        }

        public function author()
        {
            return $this->belongsTo(config('support-tickets-notifications.user_class'));
        }

        public function readers()
        {
            return $this->belongsToMany(config('support-tickets-notifications.user_class'), 'messages_readers')->withTimestamps();
        }
    }
