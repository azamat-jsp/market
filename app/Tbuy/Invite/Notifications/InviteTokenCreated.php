<?php

namespace App\Tbuy\Invite\Notifications;

use App\Tbuy\Company\Models\Company;
use App\Tbuy\Invite\Models\Invite;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class InviteTokenCreated extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public readonly string $token,
        public readonly int $company_id,
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
    public function toMail(Invite $invite): MailMessage
    {
        $company = Company::query()->find($this->company_id);
        $url = URL::format(config('app.front_url'), '/invite/activate/' . $this->token);

        return (new MailMessage)
            ->subject('You have been invited')
            ->line('You have been invited to company ' . $company->name)
            ->action('Accept invitation', $url)
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
