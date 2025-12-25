<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegisteredNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
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
        $resetUrl =  $notifiable->email;
        return (new MailMessage)
        ->subject('Reset Kata Sandi - DesaGO')
        ->greeting('Halo ' . $notifiable->name . ' !')
        ->line('Klik tombol di bawah untuk reset kata sandi')
        ->action('Reset Kata Sandi', $resetUrl) 
        ->line('Tautan ini akan kedaluwarsa dalam 5 menit.')
        ->line('Jika Anda tidak meminta reset kata sandi, abaikan email ini.')
        ->salutation('Tim DesaGO');  
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
