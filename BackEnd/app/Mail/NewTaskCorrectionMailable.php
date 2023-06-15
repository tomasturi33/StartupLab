<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class NewTaskCorrectionMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $module;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( User $user, string $module )
    {
        $this->user = $user;
        $this->module = $module;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $host = env('APP_URL');

        var_dump($host);

        return $this->view('emails.NewTaskCorrection', [    'user' => $this->user,
                                                            'module' => $this->module,
                                                            'url' =>  $host] );
    }
}
