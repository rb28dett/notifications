<?php

namespace RB28DETT\Notifications\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use RB28DETT\Notifications\Models\Notification;
use RB28DETT\Notifications\Models\Settings;
use RB28DETT\Notifications\Notifications\MessageNotification;
use RB28DETT\Users\Models\User;

class NotificationsController extends Controller
{
    /**
     * Display a listing of all the notifications.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rb28dett_notifications::index', ['user' => User::findOrFail(Auth::id())]);
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

        return view('rb28dett_notifications::show', ['notification' => $notification]);
    }

    /**
     * Show the form for creating a new notification.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Notification::class);

        return view('rb28dett_notifications::create');
    }

    /**
     * Store a newly created notification in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Notification::class);

        $this->validate($request, [
            'email'   => 'required|email|exists:users,email',
            'subject' => 'required|min:10|max:30',
            'message' => 'required|max:1500',
        ]);

        $me = User::findOrFail(Auth::id());

        User::where(['email' => $request->email])->first()
                    ->notify(new MessageNotification($request->subject, $request->message, $me));

        return redirect()->route('rb28dett::notifications.index')->with('success', __('rb28dett_notifications::general.notification_sent'));
    }

    /**
     * Save the notification settings.
     *
     * @param Illuminate\Http\Request $request
     */
    public function settings(Request $request)
    {
        $this->authorize('update', Settings::class);

        $settings = Settings::first();

        $settings->update([
            'mail_enabled' => $request->mail_enabled ? true : false,
        ]);

        $settings->touch();

        return redirect()->route('rb28dett::settings.index', ['p' => 'Notifications'])->with('success', __('rb28dett_notifications::general.settings_updated'));
    }
}
