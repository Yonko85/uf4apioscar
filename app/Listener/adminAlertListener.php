<?php

namespace App\Listener;

use App\Events\loginControlEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class adminAlertListener
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
        if(session_status() === PHP_SESSION_NONE) session_start();
        if($_SESSION['intentos'] == 3){
            $_SESSION['block'] = true;
            $_SESSION['error'] = 'Se ha notificado al administrador de tres intentos de acceso fallidos.';
        }
    }
}
