<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

use App\Mail\NewTaskCorrectionMailable;
use Illuminate\Support\Facades\Mail;

class NewTaskCorrection extends Notification
{
    use Queueable;

    protected $user;
    protected $module;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user,  string $module)
    {
        $this->user = $user;
        $this->module = $module;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return ( new NewTaskCorrectionMailable($this->user, $this->module ) )
                    ->subject('UNL Potencia: tarea corregida')
                    ->to($this->user->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
