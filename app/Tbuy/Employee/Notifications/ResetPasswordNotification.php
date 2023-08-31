<?php

namespace App\Tbuy\Employee\Notifications;

use App\Tbuy\Company\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public readonly string $password,
        public readonly int    $company_id,
        public readonly string $username,
    )
    {
        //
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
    public function toMail(object $notifiable): MailMessage
    {
        $company = Company::query()->find($this->company_id);

        return (new MailMessage)
            ->line('Your new password for company ' . $company->name)
            ->line("\n")
            ->line('Your credentials:')
            ->line('Username: ' . $this->username)
            ->line('Password: ' . $this->password)
            ->line('Thank you for using our application!');
    }
}
