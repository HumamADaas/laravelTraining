<?php

namespace App\Notifications\EventAndListener;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailAfterEvent extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $message, $title;

    public function __construct($mesaage,$title)
    {
        $this->message = $mesaage;
        $this->title = $title;
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
        return (new MailMessage)
            ->subject($this->title)
            ->line('the listener for login event is sending email')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!')
            ->line($this->message);
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
