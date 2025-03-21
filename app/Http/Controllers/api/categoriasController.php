<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class categoriasController extends Controller
{
    //CRUD
    public function store(Request $request) {

        $validador = Validator::make($request->all(),[
            'nombre_categoria' => 'required|string|max:255',
        ]);

        if ($validador -> fails()){
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validador->errors(),
                'status' => 400
            ], 400);
        }

        $categorias = Categorias::create([
            'nombre_categoria' => $request->nombre_categoria,
        ]);

        if (!$categorias){
            return response()->json([
                'message' => 'Error al crear el pordcuto',
                'status' => 500
            ], 500);
        }

        return response()->json([
            'producto' => $categorias,
            'message' => 'Categorias creado exitosamente',
            'status' => 201
        ], 201);
        
    }

    public function index(){
        $categorias = Categorias::all();
        if($categorias -> isEmpty()){
            return response() -> json(['message'=>'No Hay Registros'],404);
        }
        return response() -> json($categorias,200);
    }


    public function show($id){
        $categorias = Categorias::find($id);
        if (!$categorias) {
            $data = [
                'message'=> 'categorias no encontrado',
                'status'=> 404
            ];

            return response()-> json ($data,404);
        }

        $data = [
            'categorias'=> $categorias,
            'status'=> 200
        ];

        return response()-> json ($data,200);

    }

    public function update(Request $request,$id) {
        $categorias = Categorias::find($id);

        if (!$categorias) {
            $data = [
                'message'=> 'categorias no encontrado',
                'status'=> 404
            ];

            return response()-> json ($data,404);
        }

        $validador = Validator::make($request->all(),[
            'nombre_categoria' => 'required|string|max:255',
        ]);

        if ($validador -> fails()){
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validador->errors(),
                'status' => 400
            ], 400);
        }

        $categorias->nombre_categoria = $request->nombre_categoria;

        try {
            $categorias->save();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el categorias',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }

        return response()->json([
            'message' => 'categorias actualizado exitosamente',
            'auto' => $categorias,
            'status' => 200
        ], 200);

    }

    public function destroy ($id){
        $categorias = Categorias::find($id);

        if(!$categorias){
            $data = [
                'message'=> 'Registro no encontrado',
                'status'=> 404
            ];

            return response()-> json ($data,404);
        }
        
        $categorias -> delete();
        $data = [
            'message'=> 'Registro eliminado',
            'status'=> 200
        ];
        return response()-> json ($data,200);
    }
    

}
