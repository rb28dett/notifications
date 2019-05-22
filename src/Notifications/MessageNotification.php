<?php

namespace RB28DETT\Notifications\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use RB28DETT\Notifications\Models\Settings;

class MessageNotification extends Notification
{
    use Queueable;

    public $subject;
    public $message;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($subject, $message, $user = null)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return Settings::first()->mail_enabled ? ['mail', 'database'] : ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
                    ->subject($this->subject)
                    ->greeting(__('rb28dett_notifications::general.new_notification'))
                    ->line(__('rb28dett_notifications::general.new_message'))
                    ->action(__('rb28dett_notifications::general.view_notification'), route('rb28dett::notifications.index'));
    }

    /**
     * Get the database representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'subject' => $this->subject,
            'message' => $this->message,
            'user'    => $this->user,
        ];
    }
}
