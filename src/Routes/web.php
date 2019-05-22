<?php

Route::group([
        'middleware' => [
            'web', 'rb28dett.base', 'rb28dett.auth',
        ],
        'prefix'    => config('rb28dett.settings.base_url'),
        'namespace' => 'RB28DETT\Notifications\Controllers',
        'as'        => 'rb28dett::',
    ], function () {
        Route::post('notifications/settings', 'NotificationsController@settings')->name('notifications.settings.update');
        Route::resource('notifications', 'NotificationsController', ['only' => ['index', 'show', 'create', 'store']]);
    });

    Route::group([
            'middleware' => [
                'web', 'rb28dett.base',
            ],
            'prefix'    => '/',
            'namespace' => 'RB28DETT\Notifications\Controllers',
            'as'        => 'rb28dett_public::',
        ], function () {
            Route::resource('notifications', 'PublicController', ['only' => ['index', 'show']]);
        });
