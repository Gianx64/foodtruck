<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoggedIn extends Mailable
{
    use Queueable, SerializesModels;

    public $address;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($address)
    {
        $this->address = $address;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.loggedIn');
    }
}
