<?php

namespace App\Tbuy\User\Notifications;

use App\Tbuy\User\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class ForgotPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public readonly string $token)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(User $user): MailMessage
    {
        $url = URL::format(config('app.front_url'), '/reset-password/'.$this->token);

        return (new MailMessage)
            ->line('You have requested a password change')
            ->action('Reset password', $url);
    }
}
