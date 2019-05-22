<?php

namespace RB28DETT\Notifications\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use RB28DETT\Notifications\Models\Notification;
use RB28DETT\Users\Models\User;

class PublicController extends Controller
{
    /**
     * Display a listing of all the notifications.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        return view('rb28dett_notifications::public.index', ['notifications' => $user->notifications]);
    }

    /**
     * Display the notification.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        $this->authorize('view', $notification);

        $notification->markAsRead();

        return view('rb28dett_notifications::public.show', ['notification' => $notification]);
    }
}
