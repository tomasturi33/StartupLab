<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordRecoveyMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subjet = 'Programa UNLPotencia';
    public $name = '';
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $url)
    {
        $this->name = $name;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.passwordRecovery', ['name' => $this->name, 'url' => $this->url ])
                        ->subject('Programa UNLPotencia');
    }
}
