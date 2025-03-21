<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\productosController;
use App\Http\Controllers\api\categoriasController;



//Rutas para productos
Route::get('/productos', [productosController::class, 'index']);
route::get('/productos/{id}', [productosController::class, 'show']);
route::post('/productos', [productosController::class, 'store']);
route::put('/productos/{id}', [productosController::class, 'update']);
route::delete('/productos/{id}', [productosController::class, 'destroy']);


//Rutas para categorias
Route::get('/categorias', [categoriasController::class, 'index']);
route::get('/categorias/{id}', [categoriasController::class, 'show']);
route::post('/categorias', [categoriasController::class, 'store']);
route::put('/categorias/{id}', [categoriasController::class, 'update']);
route::delete('/categorias/{id}', [categoriasController::class, 'destroy']);

//Rutas para proveedores
