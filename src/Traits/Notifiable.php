<?php

namespace RB28DETT\Notifications\Traits;

use Illuminate\Notifications\RoutesNotifications;

trait Notifiable
{
    use HasRB28DETTNotifications, RoutesNotifications;
}
