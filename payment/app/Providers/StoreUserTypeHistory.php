<?php

namespace App\Providers;

use App\Providers\UserTypeHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StoreUserTypeHistory
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
     * @param  \App\Providers\UserTypeHistory  $event
     * @return void
     */
    public function handle(UserTypeHistory $event)
    {
        //
    }
}
