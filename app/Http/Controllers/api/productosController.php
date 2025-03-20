<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\productos;

class productosController extends Controller
{
    //

    public function index(){
        $productos = productos::all();
        if($productos -> isEmpty()){
            return response() -> json(['message'=>'No Hay Registros'],404);
        }
        return response() -> json($productos,200);
    }
}
