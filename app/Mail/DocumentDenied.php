<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DocumentDenied extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($plate, $foodtruck_name, $document_name)
    {
        $this->plate = $plate;
        $this->foodtruck_name = $foodtruck_name;
        $this->document_name = $document_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.documentDenied', ['url' => env('APP_URL').'/profile']);
    }
}
