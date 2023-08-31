<?php

namespace App\Jobs;

use App\Models\Application;
use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ApplicationsClean implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $events = Event::where('date', '>', date("Y").'-'.date("m").'-'.date("d").' 00:00:00')->where('date', '<', date("Y").'-'.date("m").'-'.date("d").' 23:59:59')->get();
        foreach($events as $event)
            Application::where('event_id', $event->id)->where('approved', 0)->delete();
    }

    public function failed(\Throwable $e) {
        info('Job ApplicationsClear has failed!');
    }
}
