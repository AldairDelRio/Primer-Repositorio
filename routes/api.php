<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\productosController;


//Rutas para productos
Route::get('/productos', [productosController::class, 'index']);
