<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestStatusChanged extends Notification
{
    use Queueable;

    /**
     * The request instance.
     *
     * @var object
     */
    private $request;
    protected $oldStatus;

    /**
     * Create a new notification instance.
     *
     * @param object $request
     * @param string $oldStatus
     */
    public function __construct(object $request, string $oldStatus)
    {
        $this->request = $request;
        $this->oldStatus = $oldStatus;
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
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting("Hello {$notifiable->name},")
            ->subject("Maintenance Request Status Changed: {$this->request->title}")
            ->line("The status of your maintenance request titled **{$this->request->title}** has changed from **{$this->oldStatus}** to **{$this->request->status}**.")
            ->line("You can check the details in your dashboard using the button below.")
            ->action('View Request', url: route('requests.index'))
            ->salutation('Thanks for using our platform!')
            ->salutation("Best regards,\n" . config('app.name'));
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
