<?php

use Illuminate\Support\Facades\Route;

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
    return view('/home');
});

Route::get('/actividades', function () {
    return view('/actividades');
});

Route::delete('inventario/{inventario}', 'InventarioController@destroy')->name('inventario.destroy');
Route::delete('asignacion_prods/{asignacion_prods}', 'AsignacionProdController@destroy')->name('asignacion_prods.destroy');
Route::put('inventario/{inventario}/update', 'InventarioController@update')->name('inventario.update');
Route::get('citas/buscarCliente', 'CitasController@buscarCliente')->name('citas.buscarCliente');
Route::get('citas/nombreCliente', 'CitasController@nombreCliente')->name('citas.nombreCliente');
Route::put('citas/{cita}/update', 'CitasController@update')->name('citas.update');

Route::resource('usuarios', 'UsuariosController');

Route::resource('actividades', 'ActividadesController')->middleware('auth');

Route::resource('inventario', 'InventarioController')->middleware('auth');

Route::resource('productos', 'ProductosController')->middleware('auth');

Route::resource('roles', 'RolesController')->middleware('auth');

Route::resource('citas', 'CitasController')->middleware('auth');

Route::resource('categoriaprods', 'CategoriaProdController')->middleware('auth');

Route::resource('asignacion_prods', 'AsignacionProdController')->middleware('auth');

Auth::routes();
