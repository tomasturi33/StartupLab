<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class NewTaskUploadedMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $evaluator;
    public $entrepreneurship;
    public $module;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( User $evaluator, string $entrepreneurship, string $module )
    {
        $this->evaluator = $evaluator;
        $this->entrepreneurship = $entrepreneurship;
        $this->module = $module;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.NewTaskUploaded', [  'evaluator' => $this->evaluator,
                                                        'entrepreneurship' => $this->entrepreneurship,
                                                        'module' => $this->module, ] );
    }
}
