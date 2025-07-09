<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\User;

class NuevoUsuarioRegistrado extends Notification
{
    use Queueable;

    public User $nuevoUsuario;

    public function __construct(User $nuevoUsuario)
    {
        $this->nuevoUsuario = $nuevoUsuario;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nuevo usuario registrado')
            ->greeting('Hola, administrador')
            ->line('Se ha registrado un nuevo usuario:')
            ->line('Nombre: ' . $this->nuevoUsuario->name)
            ->line('Email: ' . $this->nuevoUsuario->email)
            ->line('Fecha: ' . now()->format('d/m/Y H:i'))
            ->action('Ver usuarios', url('/users'))
            ->line('Este es un mensaje automático del sistema.');
    }
}

