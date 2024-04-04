<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeProfessionalsNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public User $user
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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Bem Vindo(a) a Agendaria!')
                    ->greeting("Olá {$this->user->name}")
                    ->line("Bem Vindo(a) a Agendaria! Seu cadastro foi realizado com sucesso!")
                    ->line('Agora você pode acessar a plataforma e começar a utilizar nossos serviços.')
                    ->action('Acessar Plataforma', url('/'))
                    ->line('Obrigado por utilizar nossa aplicação!')
                    ->salutation('Atenciosamente, Agendaria');
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
