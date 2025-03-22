<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\Proveedores;


class proveedoresController extends Controller
{
    public function store(Request $request) {
        $validador = Validator::make($request->all(),[
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
        ]);

        if ($validador -> fails()){
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validador->errors(),
                'status' => 400
            ], 400);
        }

        $proveedor = Proveedores::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
        ]);

        if (!$proveedor){
            return response()->json([
                'message' => 'Error al crear el proveedor',
                'status' => 500
            ], 500);
        }

        return response()->json([
            'producto' => $proveedor,
            'message' => 'proveedor creado exitosamente',
            'status' => 201
        ], 201);

    }

    public function index(){
        $proveedor = Proveedores::all();
        if($proveedor -> isEmpty()){
            return response() -> json(['message'=>'No Hay Registros'],404);
        }
        return response() -> json($proveedor,200);
    }

    public function show($id){
        $proveedor = Proveedores::find($id);
        if (!$proveedor) {
            $data = [
                'message'=> 'Proveedor no encontrado',
                'status'=> 404
            ];

            return response()-> json ($data,404);
        }

        $data = [
            'proveedor'=> $proveedor,
            'status'=> 200
        ];

        return response()-> json ($data,200);

    }

    public function update(Request $request,$id) {
        $proveedor = Proveedores::find($id);

        if (!$proveedor) {
            $data = [
                'message'=> 'proveedor no encontrado',
                'status'=> 404
            ];

            return response()-> json ($data,404);
        }

        $validador = Validator::make($request->all(),[
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
        ]);

        if ($validador -> fails()){
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validador->errors(),
                'status' => 400
            ], 400);
        }
        $proveedor->nombre = $request->nombre;
        $proveedor->email = $request->email;
        $proveedor->telefono = $request->telefono;
        $proveedor->direccion = $request->direccion;
        try {
            $proveedor->save();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el proveedor',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }

        return response()->json([
            'message' => 'proveedor actualizado exitosamente',
            'auto' => $proveedor,
            'status' => 200
        ], 200);

    }

    public function destroy ($id){
        $proveedor = Proveedores::find($id);

        if(!$proveedor){
            $data = [
                'message'=> 'Registro no encontrado',
                'status'=> 404
            ];

            return response()-> json ($data,404);
        }
        
        $proveedor -> delete();
        $data = [
            'message'=> 'Registro eliminado',
            'status'=> 200
        ];
        return response()-> json ($data,200);
    }
}
