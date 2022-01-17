<?php

namespace App\Listener;

use App\Events\loginControlEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Log;

class logListener
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
     * @param  loginControlEvent  $event
     * @return void
     */
    public function handle(loginControlEvent $event)
    {
        Log::alert("Una contraseña errónea ha sido introducida.");
    }
}
