<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Application extends Mailable
{
    use Queueable, SerializesModels;
    
    public $event_id, $event_name, $plate, $foodtruck_name, $foods;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($event_id, $plate, $foodtruck_name, $foods)
    {
        $this->event_id = $event_id;
        $record = Event::findOrFail($event_id);
        $this->event_name = $record-> name;
        $this->plate = $plate;
        $this->foodtruck_name = $foodtruck_name;
        $this->foods = $foods;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.application', ['url' => env('APP_URL').'/events/'.strval($this->event_id)]);
    }
}