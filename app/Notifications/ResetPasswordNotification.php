<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Support\Facades\Url;

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
        
  
    // reset password via web
    // $resetUrl = url('/reset-password/' . $this->token . '?email=' . $notifiable->email);
    //     return (new MailMessage)
    //         ->subject('Reset Kata Sandi - DESAGO')
    //         ->greeting('Halo ' . $notifiable->name . '!')
    //         ->line('Kami menerima permintaan reset kata sandi untuk akun Anda.')
    //         ->action('Reset Kata Sandi', $resetUrl)
    //         ->line('Tautan ini akan kedaluwarsa dalam 60 menit.')
    //         ->line('Jika Anda tidak meminta reset kata sandi, abaikan email ini.')
    //         ->salutation('Salam, DESAGO');
    //
    // reset password via mobile
        //  $resetUrl = "com.example.desago://reset-password?token={$this->token}&email={$notifiable->email}";
        $resetUrl = url('/reset-password?token=' . $this->token . '&email=' . $notifiable->email);
        // $resetUrl = 'https:https://londa-proinsurance-nonsalubriously.ngrok-free.dev/api/reset-password?token=' . $this->token . '&email=' . $notifiable->email;
        // $resetUrl = "com.example.desago://reset-password?token={$this->token}&email={$notifiable->email}";
        //   $resetUrl = url('/reset-password/.well-known/assetlinks.json');
    return (new MailMessage)
        ->subject('Reset Kata Sandi - DesaGO')
        ->greeting('Halo ' . $notifiable->name . ' !')
        ->line('Klik tombol di bawah untuk reset kata sandi')
        ->action('Reset Kata Sandi', $resetUrl) 
        ->line('Tautan ini akan kedaluwarsa dalam 5 menit.')
        ->line('Jika Anda tidak meminta reset kata sandi, abaikan email ini.')
        ->salutation('Tim DesaGO');  
}
}

