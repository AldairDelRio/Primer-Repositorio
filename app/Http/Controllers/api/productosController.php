<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\productos;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class productosController extends Controller
{

    public function store(Request $request) {
        $validador = Validator::make($request->all(),[
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'imagen' => 'nullable|string',
            'categoria_id' => 'required|integer',
        ]);

        if ($validador -> fails()){
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validador->errors(),
                'status' => 400
            ], 400);
        }

        $producto = productos::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'imagen' => $request->imagen,
            'categoria_id' => $request->categoria_id,
        ]);

        if (!$producto){
            return response()->json([
                'message' => 'Error al crear el pordcuto',
                'status' => 500
            ], 500);
        }

        return response()->json([
            'producto' => $producto,
            'message' => 'Producto creado exitosamente',
            'status' => 201
        ], 201);

    }

    public function index(){
        $productos = productos::all();
        if($productos -> isEmpty()){
            return response() -> json(['message'=>'No Hay Registros'],404);
        }
        return response() -> json($productos,200);
    }

    public function show($id){
        $producto = productos::find($id);
        if (!$producto) {
            $data = [
                'message'=> 'Producto no encontrado',
                'status'=> 404
            ];

            return response()-> json ($data,404);
        }

        $data = [
            'producto'=> $producto,
            'status'=> 200
        ];

        return response()-> json ($data,200);

    }

    public function update(Request $request,$id) {
        $producto = productos::find($id);

        if (!$producto) {
            $data = [
                'message'=> 'Producto no encontrado',
                'status'=> 404
            ];

            return response()-> json ($data,404);
        }

        $validador = Validator::make($request->all(),[
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'imagen' => 'nullable|string',
            'categoria_id' => 'required|integer',
        ]);

        if ($validador -> fails()){
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validador->errors(),
                'status' => 400
            ], 400);
        }

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->imagen = $request->imagen;
        $producto->categoria_id = $request->categoria_id;

        try {
            $producto->save();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el producto',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }

        return response()->json([
            'message' => 'producto actualizado exitosamente',
            'auto' => $producto,
            'status' => 200
        ], 200);

    }


    public function destroy ($id){
        $producto = productos::find($id);

        if(!$producto){
            $data = [
                'message'=> 'Registro no encontrado',
                'status'=> 404
            ];

            return response()-> json ($data,404);
        }
        
        $producto -> delete();
        $data = [
            'message'=> 'Registro eliminado',
            'status'=> 200
        ];
        return response()-> json ($data,200);
    }
}

