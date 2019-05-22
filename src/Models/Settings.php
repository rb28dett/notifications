<?php

namespace RB28DETT\Notifications\Models;

use Illuminate\Notifications\DatabaseNotification;

class Settings extends DatabaseNotification
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rb28dett_notifications_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mail_enabled',
    ];
}
