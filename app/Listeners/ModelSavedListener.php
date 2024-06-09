<?php

namespace App\Listeners;

use App\Events\EventModelSavedInterface;
use App\Events\SubmissionJobSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ModelSavedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EventModelSavedInterface $event): void
    {
        $event->execute();
    }
}
