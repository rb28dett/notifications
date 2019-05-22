<?php

return [
    [
        'text'    => __('rb28dett_notifications::general.my_notifications'),
        'url'     => route('rb28dett::notifications.index'),
        'counter' => RB28DETT\Users\Models\User::findOrFail(Auth::id())->unreadNotifications->count(),
    ],
    [
        'text'       => __('rb28dett_notifications::general.create_notification'),
        'url'        => route('rb28dett::notifications.create'),
        'permission' => 'rb28dett::notifications.create',
    ],
];
