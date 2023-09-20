<?php

namespace App\Mail;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationApproved extends Mailable
{
    use Queueable, SerializesModels;
    
    public $event_id, $event_name, $event_date, $plate, $foodtruck_name, $foods;

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
        $this->event_date = $record-> date;
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
        return $this->markdown('emails.applicationApproved', ['url' => env('APP_URL').'/event/{{$this->event_id}}']);
    }
}