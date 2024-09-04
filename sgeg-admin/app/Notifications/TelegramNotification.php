<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use NotificationChannels\Telegram\TelegramMessage;
use Illuminate\Notifications\Notification;

class TelegramNotification extends Notification
{
 
    /**
     * Create a new message instance.
     */
    public function __construct(public $message)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ["telegram"];
    }

    public function toTelegram($notifiable)
    {

        return TelegramMessage::create()
        ->content('SGEG')
            ->line("Your invoice has been *PAID*")
            ->line("Thank you!"); //->view('index');
    }
}
