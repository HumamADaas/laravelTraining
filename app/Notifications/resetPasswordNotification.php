<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class resetPasswordNotification extends Notification
{
    use Queueable;

    private $token;
    private $user;

    public function __construct($token, $user)
    {
        if ($token && $user) {
            $this->token = $token;
            $this->user = $user;
        }
        return redirect()->route('getLogin');
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


    public function toMail(object $notifiable): MailMessage
    {
        $url = URL::temporarySignedRoute('VNP', Carbon::now()->addMinutes(0.0), ['token' => $this->token]);
        return (new MailMessage)
            ->action('Reset Password', $url)
            ->view('Auth.buttonReset', [
                'token' => $this->token,
                'user' => $this->user,
            ]);
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
