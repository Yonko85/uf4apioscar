<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\accesoController;
use App\Http\Controllers\CustomAuthController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

session_start();

if(isset($_SESSION['block']) && $_SESSION['block'] == true) {

	Route::fallback(function () { return view('accesoBloqueado');});

} else {

	Route::get('/', function () { return view('welcome');});

	Route::get('/zonaRestringida', [accesoController::class, 'zonaRestringida']);

	Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 

	Route::get('login', [CustomAuthController::class, 'index'])->name('login');

	Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 

	Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

}

