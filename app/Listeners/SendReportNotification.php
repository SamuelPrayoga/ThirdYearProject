<?php

namespace App\Listeners;

use App\Events\AllergyReportCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendReportNotification
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
     * @param  \App\Events\AllergyReportCreated  $event
     * @return void
     */
    public function handle(AllergyReportCreated $event)
    {
        $admin = User::where('approved', true)->first();

        if ($admin) {
            $admin->notify(new AllergyReportCreatedNotification($event->allergyReport));
        }
    }
}
