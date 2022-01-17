<?php

namespace App\Http\Controllers;

use App\Events\userAccessEvent;
use Illuminate\Http\Request;

class accesoController extends Controller
{
    public function zonaRestringida()
    {
        session_start();
        $_SESSION['access'] = true;
        $_SESSION['error']='';

        event(new userAccessEvent);
        //$_SESSION['access'] = true; //Descomentar esta línea servirá para testear la vista 'zonaRestringida'
        if ($_SESSION['access'])
            return view('zonaRestringida');
        else
            return view('accesoBloqueado');
    }
}
