<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\productosController;
use App\Http\Controllers\api\categoriasController;
use App\Http\Controllers\api\proveedoresController;


//Rutas para productos
Route::get('/productos', [productosController::class, 'index']);
Route::get('/productos/{id}', [productosController::class, 'show']);
Route::post('/productos', [productosController::class, 'store']);
Route::put('/productos/{id}', [productosController::class, 'update']);
Route::delete('/productos/{id}', [productosController::class, 'destroy']);


//Rutas para categorias
Route::get('/categorias', [categoriasController::class, 'index']);
Route::get('/categorias/{id}', [categoriasController::class, 'show']);
Route::post('/categorias', [categoriasController::class, 'store']);
Route::put('/categorias/{id}', [categoriasController::class, 'update']);
Route::delete('/categorias/{id}', [categoriasController::class, 'destroy']);

//Rutas para proveedores
Route::get('/Proveedores', [proveedoresController::class, 'index']);
Route::get('/Proveedores/{id}', [proveedoresController::class, 'show']);
Route::post('/Proveedores', [proveedoresController::class, 'store']);
Route::put('/Proveedores/{id}', [proveedoresController::class, 'update']);
Route::delete('/Proveedores/{id}', [proveedoresController::class, 'destroy']);