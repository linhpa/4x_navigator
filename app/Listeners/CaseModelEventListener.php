<?php

namespace App\Listeners;

use App\Events\CaseModelEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Logger;
use App\User;

class CaseModelEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ModelEvent  $event
     * @return void
     */
    public function handle(CaseModelEvent $event)
    {
        if (!$event->user instanceof User) {
            return;
        }

        Logger::create([
            'user_id'       =>  $event->user->id,
            'subject'    =>  $event->subject,
            'description'    =>  $event->description,
        ]);
    }
}
