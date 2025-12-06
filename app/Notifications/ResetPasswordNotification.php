<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Auth\CanResetPassword;

class ResetPasswordNotification extends Notification
{
    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $resetUrl = url('/reset-password/' . $this->token . '?email=' . $notifiable->email);

        return (new MailMessage)
            ->subject('Reset Kata Sandi - DESAGO')
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Kami menerima permintaan reset kata sandi untuk akun Anda.')
            ->action('Reset Kata Sandi', $resetUrl)
            ->line('Tautan ini akan kedaluwarsa dalam 60 menit.')
            ->line('Jika Anda tidak meminta reset kata sandi, abaikan email ini.')
            ->salutation('Salam, DESAGO');
    }
}

