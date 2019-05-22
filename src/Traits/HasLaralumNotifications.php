<?php

namespace RB28DETT\Notifications\Traits;

use Illuminate\Notifications\HasDatabaseNotifications;
use RB28DETT\Notifications\Models\Notification;

trait HasRB28DETTNotifications
{
    use HasDatabaseNotifications;

    /**
     * Get the entity's notifications.
     */
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable')
                            ->orderBy('created_at', 'desc');
    }
}
