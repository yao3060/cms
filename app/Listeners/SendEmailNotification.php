<?php

namespace App\Listeners;

use App\Mail\OldUserWelcome;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailNotification
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
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        // get logged in user's email and username
        $email = $event->user->email;
        $username = $event->user->name;

        // send email notification about login
        Mail::to($email)
            ->send(new OldUserWelcome($event->user));
    }
}
