<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Events\loginControlEvent;

class CustomAuthController extends Controller
{

    private $usuarios = array("admin@admin.com" => "admin", "user@user.com" => "user");

    public function index()
    {
        return view('welcome');
    }  
      

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        if(session_status() === PHP_SESSION_NONE) session_start();
        
        if (isset($this->usuarios[$request->email]) && $this->usuarios[$request->email] == $request->password) {
            $_SESSION['access'] = true;
            $_SESSION['email'] = $request->email;
            return redirect()->intended('dashboard')->withSuccess('Signed in');
        } else {
            if(!isset($_SESSION['intentos'])){
                $_SESSION['intentos'] = 1;
            } else {
                $_SESSION['intentos'] = $_SESSION['intentos'] + 1;
            }

            event(new loginControlEvent());
            return redirect("login")->withErrors(['msg' => 'Credenciales incorrectas.']);
        }
    }
    
    public function dashboard()
    {
        if(session_status() === PHP_SESSION_NONE) session_start();
        if ($_SESSION['access']) {
            return view('zonaRestringida');
        } else {
            return redirect("login")->withSuccess('No puedes entrar sin loguearte.');
        }
    }
    

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}