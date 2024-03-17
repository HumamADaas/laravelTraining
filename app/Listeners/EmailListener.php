<?php

namespace App\Listeners;

use App\Notifications\EventAndListener\EmailLogin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EmailListener
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
    public function handle(object $event): void
    {
        //return the variable type
//        var_dump($event->user);
        $user = $event->user;

        // Call the notify() method on the User object
        $user->notify(new EmailLogin());
    }
}
