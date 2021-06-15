<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogEventListener
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
     * @param  DeployDisabledEvent  $event
     * @return void
     */
    public function handle($event)
    {
        // if ($event->type == 'error') {
        //     $this->notifyViaSlack($event->message, $event->context);
        // }
    }

    /**
     * Send Slack notification.
     *
     * @param  string  $message
     * @param  string  $context
     * @return void
     */
    // protected function notifyViaSlack($message, $context)
    // {
    //     /*
    //      * Slack notification logic
    //      */
    //     return (new SlackMessage)
    //     ->from('NEW ERP', ':ghost:')
    //     ->to('#app-error-logs')
    //     ->content('Testing new ERP slack error notifier');
    // }  
}
