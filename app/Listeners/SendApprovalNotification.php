<?php

namespace App\Listeners;

use App\Events\AllergyReportApproved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendApprovalNotification
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
     * @param  \App\Events\AllergyReportApproved  $event
     * @return void
     */
    public function handle(AllergyReportApproved $event)
    {
        $user = $event->allergyReport->user;

        $user->notify(new AllergyReportApprovedNotification($event->allergyReport));
    }
}
