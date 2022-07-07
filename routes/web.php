<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InicioController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\GenerosController;
use App\Http\Controllers\AutoresController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\PedidosController;

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
    return view('modulos.Ingresar');
});

Route::get('storage-link', function(){
  return  Artisan::call('storage:link');
});


Auth::routes();

Route::get('Inicio', [InicioController::class, 'index']);

Route::get('Mis-datos',[UsuariosController::class, 'MisDatos']);
Route::put('Mis-datos',[UsuariosController::class, 'DatosUpdate']);

Route::get('Usuarios',[UsuariosController::class, 'index']);
Route::post('Usuarios',[UsuariosController::class, 'store']);
Route::get('Eliminar-Usuario/{id}',[UsuariosController::class, 'destroy']);
Route::get('Editar-Usuario/{id}', [UsuariosController::class, 'edit']);
Route::put('actualizar-Usuario/{id}', [UsuariosController::class, 'update']);


Route::get('Clientes',[ClientesController::class, 'index']);
Route::post('Clientes',[ClientesController::class, 'store']);
Route::get('Editar-Cliente/{id}',[ClientesController::class, 'edit']);
Route::put('actualizarC/{id}',[ClientesController::class, 'update']);
Route::get('Eliminar-Cliente/{id}',[ClientesController::class, 'destroy']);
Route::post('Crear-Ventas',[ClientesController::class, 'CrearClienteVenta']);

Route::get('Generos',[GenerosController::class, 'index']);
Route::post('Generos',[GenerosController::class, 'store']);
Route::put('Actualizar-Genero/{genero}',[GenerosController::class, 'update']);
Route::get('Eliminar-Genero/{id}',[GenerosController::class, 'destroy']);
Route::get('Genero-Libros/{id_genero}',[GenerosController::class, 'GeneroLibros']);

Route::get('Autores',[AutoresController::class, 'index']);
Route::get('Agregar-Autor',[AutoresController::class, 'create']);
Route::post('Agregar-Autor',[AutoresController::class, 'store']);
Route::delete('Quitar-Autor/{autor}',[AutoresController::class, 'delete']);
Route::get('Autor-Libros/{id_Autor}',[AutoresController::class, 'AutorLibros']);

Route::get('Libros',[LibroController::class, 'index']);
Route::post('Libros',[LibroController::class, 'store']);
Route::get('Libro-S/{id}',[LibroController::class, 'show']);
Route::get('Libro-E/{id}',[LibroController::class, 'edit']);
Route::put('Libro-A/{id}',[LibroController::class, 'update']);
Route::get('Libro-Q/{id}',[LibroController::class, 'destroy']);

Route::get('Crear-Ventas',[VentasController::class, 'create']);
Route::post('Crear-Ventas',[VentasController::class, 'store']);
Route::get('Venta/{id}',[VentasController::class, 'venta']);
Route::post('Venta/{id}',[VentasController::class, 'agregarLibroVenta']);
Route::post('Quitar-Libro-Venta/{id}',[VentasController::class, 'QuitarLibroVenta']);
Route::post('FinalizarVenta',[VentasController::class, 'FinalizarVenta']);
Route::get('Ver-Ventas',[VentasController::class, 'VerVentas']);
Route::get('Ver-Venta/{id}',[VentasController::class, 'VerVenta']);

Route::get('Pedidos', [PedidosController::class, 'index']);
Route::post('Pedidos', [PedidosController::class, 'store']);
Route::get('Pedidos-Solicitados', [PedidosController::class, 'index']);
Route::get('Pedidos-EnCamino', [PedidosController::class, 'index']);
Route::get('Pedidos-Recibidos', [PedidosController::class, 'index']);
Route::get('Gestionar-Pedido/{id}', [PedidosController::class, 'Gestionar']);
Route::post('Gestionar-Pedido/{id}', [PedidosController::class, 'LibroPedido']);
Route::post('CambEstadoPed/{id}', [PedidosController::class, 'CambiarEstado']);
Route::delete('LibroP-Quitar/{id}', [PedidosController::class, 'QuitarLibroP']);
Route::post('Verificar/{id}', [PedidosController::class, 'VerificarPedido']);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
