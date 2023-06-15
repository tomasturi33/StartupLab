<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

use App\Mail\NewTaskUploadedMailable;
use Illuminate\Support\Facades\Mail;

class NewTaskUploaded extends Notification
{
    use Queueable;

    protected $evaluator;
    protected $entrepreneurship;
    protected $module;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( User $evaluator, string $entrepreneurship, string $module)
    {
        $this->evaluator = $evaluator;
        $this->entrepreneurship = $entrepreneurship;
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
        return (new NewTaskUploadedMailable($this->evaluator, $this->entrepreneurship, $this->module))
                    ->subject('Nueva tarea - UNL Potencia')
                    ->to($this->evaluator->email);
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
