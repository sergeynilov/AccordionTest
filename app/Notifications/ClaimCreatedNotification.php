<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class ClaimCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $text;
    public $title;
    public $client_name;
    public $client_email;
    public $authorUser;

    public function __construct(
        string $title,
        string $text,
        string $client_name,
        string $client_email,
        User $authorUser
    ) {
        $this->title        = $title;
        $this->client_name  = $client_name;
        $this->client_email = $client_email;
        $this->text         = $text;
        $this->authorUser   = $authorUser;
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
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown('mail.ClaimCreatedNotification', [
            'title'        => $this->title,
            'client_name'  => $this->client_name,
            'client_email' => $this->client_email,
            'text'         => $this->text,
            'authorUser'   => $this->authorUser
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title'        => $this->title,
            'client_name'  => $this->client_name,
            'client_email' => $this->client_email,
            'text'         => $this->text,
            'authorUser'   => $this->authorUser,
        ];
    }

}
