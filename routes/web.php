<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('auth.login');
});


//Direccionamos a la clase ClienteController y a la funcion create
// Route::get('cliente/create',[ClienteController::class,'create']);

//Direccionamos a la clase ClienteController y a la funcion create
// Route::get('pedido/create',[PedidoController::class,'create']);


Route::resource('cliente', ClienteController::class)->middleware('auth');
Route::resource('pedido', PedidoController::class)->middleware('auth');
Auth::routes(['register'=>false, 'reset'=>false]);

Route::get('/home', [ClienteController::class, 'index'])->name('home');

//Cuando el usuario se loguee busca el controlador y busca la clase index para ejecutarla
Route::group(['middleware'=>'auth'],function(){
    Route::get('/',[ClienteController::class, 'index'])->name('home');
});
