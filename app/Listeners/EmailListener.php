<?php

namespace App\Listeners;

use App\Events\LoginEvent;
use App\Events\Logoutevent;
use App\Notifications\EventAndListener\EmailAfterEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
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
     * Handle user login events.
     */
    public function handleUserLogin(LoginEvent $event): void
    {
        $user = $event->user;
        $message = 'login success';
        $title = 'login';
        // Call the notify() method on the User object
        $user->notify(new EmailAfterEvent($message,$title));
    }

    /**
     * Handle user logout events.
     */
    public function handleUserLogout(Logoutevent $event): void
    {
        $user = $event->user;
        $message = 'logout success';
        $title = 'logout';
        // Call the notify() method on the User object
        $user->notify(new EmailAfterEvent($message,$title));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @return array<string, string>
     */
    public function subscribe(Dispatcher $events): array
    {
        return [
            LoginEvent::class => 'handleUserLogin',
            Logoutevent::class => 'handleUserLogout',
        ];
    }

//    public function handle(object $event): void
//    {
//        //return the variable type
////        var_dump($event->user);
//        $user = $event->user;
//
//        // Call the notify() method on the User object
//        $user->notify(new EmailAfterEvent());
//    }
}
