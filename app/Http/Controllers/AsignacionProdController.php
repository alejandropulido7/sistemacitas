<?php

namespace App\Http\Controllers;

use App\asignacion_prod;
use Illuminate\Http\Request;
use App\Inventario;

class AsignacionProdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $asignacion = request()->except("_token");
        asignacion_prod::insert($asignacion);
        $id = $request->idInventario;
        $cantidad = $request->cantidadAsignada;
        
        $idInventario = Inventario::findOrfail($id);

        $nuevaCantidad = ($idInventario->cantidadProducto) - ($cantidad);

        $idInventario->cantidadProducto = $nuevaCantidad;
        $idInventario->update();
   

        return redirect()->route('inventario.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\asignacion_prod  $asignacion_prod
     * @return \Illuminate\Http\Response
     */
    public function show(asignacion_prod $asignacion_prod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\asignacion_prod  $asignacion_prod
     * @return \Illuminate\Http\Response
     */
    public function edit(asignacion_prod $asignacion_prod)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\asignacion_prod  $asignacion_prod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, idAsignacion $id)
    {
        //
        $actualizarAsignacion = asignacion_prod::findOrFail($id);
        return redirect('inventario');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\asignacion_prod  $asignacion_prod
     * @return \Illuminate\Http\Response
     */
    public function destroy(asignacion_prod $asignacion_prod)
    {
        //
        $asignacion_prod->delete();
        return redirect('inventario');
    }
}
