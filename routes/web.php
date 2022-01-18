<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;

Route::get('/', function(){
    return view('auth.login');
});
/*
//ruta meidante vista
Route::get('/empleado', function(){
    return view('empleado.index');
});

//ruta mediante clase
Route::get('empleado/create',[EmpleadoController::class,'create']);
*/
//para acceder a todos los metodos del controllers
Route::resource('empleado',EmpleadoController::class)->middleware('auth'); //gregar seguridad para que obligue a autenticarse
Auth::routes(['register'=> false, 'reset'=>false]); //para quitar el registro y recordar contraseña del login

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [EmpleadoController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'],function () {

    Route::get('/home', [EmpleadoController::class, 'index'])->name('home');
});
