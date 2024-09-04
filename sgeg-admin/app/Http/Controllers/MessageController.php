<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use NotificationChannels\Telegram\TelegramUpdates;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Notifications\TelegramNotification;

class MessageController extends Controller
{
    public function via($notifiable)
    {
        return ["telegram"];
    }

    // Check channel and get user id
    public function index()
    {
        //https://api.telegram.org/bot7314993544:AAHgQqcSMd81p7lbDB9OU2P3pgS7hcfb2zA/getUpdates
        //https://api.telegram.org/bot7314993544:AAHgQqcSMd81p7lbDB9OU2P3pgS7hcfb2zA/sendMessage?chat_id=-1002249543240&text=test123
        $updates = TelegramUpdates::create()
                        // (Optional). Get's the latest update. NOTE: All previous updates will be forgotten using this method.
                        // ->latest()
                        
                        // (Optional). Limit to 2 updates (By default, updates starting with the earliest unconfirmed update are returned).
                        ->limit(10)
                        
                        // (Optional). Add more params to the request.
                        ->options([
                            'timeout' => 0,
                        ])
                        ->get();
        $results = ""; 
        if($updates['ok']) {
            // Chat ID
            dump($updates);
            if (isset($updates['result'])) {
                $results = $updates['result'];
            }
        }

        return view('emails.message', ['results' => $results]);
    }

    public function sendMessage() {
 
        $message = "hola caracola"; // chatID = 1002249543240
        return Notification::route('telegram', '-1002249543240')->notify(new TelegramNotification($message));
        //Notification::send($recipients, new messageNotification());
 
    }
 
}
