<?php

namespace App\Listeners;

use App\Events\EventModelSavedInterface;

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
