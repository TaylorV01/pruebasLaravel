<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\FacturaDetalleController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Rutas para productos
Route::resource('productos', ProductoController::class);
Route::resource('productos', ProductoController::class);
Route::resource('clientes', ClienteController::class);
Route::resource('facturas', FacturaController::class);
Route::resource('factura-detalles', FacturaDetalleController::class);
