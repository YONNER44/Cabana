<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\VentaRequest;
use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{/*
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware(['scopes:read-registros'])->only('index','show');
        $this->middleware(['scopes:update-registros','can:update general'])->only('update');
        $this->middleware(['scopes:create-registros','can:create general'])->only('store');
        $this->middleware(['scopes:delete-registros','can:delete general'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $data=Venta::all();
            return response()->json($data,200);
        }catch(\Throwable $th){
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VentaRequest $request)
    {
        try{
            $data['metodo_pago']=$request['metodo_pago'];
            $data['estado']=$request['estado'];
            $data['total']=$request['total'];
            $data['users_doc']=$request['users_doc'];
            $ventas=Venta::create($data);
            
            return response()->json(['message' => 'Registro creado exitosamente', 'data' => $ventas], 201);
        }catch(\Throwable $th){
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            $ventas=Venta::included()->find($id);
            if(!$ventas) {
                return response()->json(['error' => 'Venta no encontrada'], 404);
            }
            return response()->json($ventas, 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VentaRequest $request,$id){
        try{
            $data['estado']=$request['estado'];
            $ventas = Venta::find($id);
            if(!$ventas) {
                return response()->json(['error' => 'Venta no encontrada'], 404);
            }
            $ventas->update($data);
            return response()->json(['message' => 'Actualización exitosa', 'data' => $ventas], 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }

    }

    public function destroy($id){
        try{
            $ventas=Venta::find($id);
            if(!$ventas) {
                return response()->json(['error' => 'Venta no encontrada'], 404);
            }
            $ventas->delete();
            return response()->json(['message' => 'Eliminación exitosa'], 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
