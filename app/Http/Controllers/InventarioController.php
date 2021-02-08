<?php

namespace App\Http\Controllers;

use App\Inventario;
use App\CategoriaProd;
use App\Productos;
use App\Usuarios;
use App\asignacion_prod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\BD;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datosCategoria = CategoriaProd::all();
        $datosInventario = Inventario::select('inventarios.id', 'inventarios.fechaEntrada', 'inventarios.cantidadProducto', 'inventarios.idProducto', 'productos.nombreProducto')
                                        ->join('productos', 'inventarios.idProducto', '=', 'productos.id')
                                        ->get();
        $datosProductos = Productos::all();
        $datosAsignacion = asignacion_prod::select('asignacion_prods.id', 'asignacion_prods.idInventario', 'inventarios.cantidadProducto','asignacion_prods.idUsuario', 'asignacion_prods.cantidadAsignada', 'productos.nombreProducto', 'usuarios.nombreCompleto')
                                            ->join('inventarios', 'asignacion_prods.idInventario', '=', 'inventarios.id')
                                            ->join('usuarios', 'asignacion_prods.idUsuario', '=', 'usuarios.id')
                                            ->join('productos', 'inventarios.idProducto', '=', 'productos.id')
                                            ->get();
        $datosUsuario = Usuarios::all();                                                
        return view('inventario.index', compact('datosCategoria', 'datosInventario', 'datosProductos', 'datosAsignacion', 'datosUsuario'));
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
        //
        $datosInventario = request()->except("_token");
        Inventario::insert($datosInventario);
        return redirect('inventario');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function show(Inventario $inventario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $editarInventario = Inventario::findOrfail($id);
        return view('inventario.index', compact('editarInventario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventario $inventario)
    {
        //
        $inventario->update($request->all());
        return redirect()->route('inventario.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventario $inventario)
    {
        //
        // $inventario=\App\Inventario::find($id);
        // $inventario->destroy($id);
        // return redirect('inventario');

        $inventario->delete();
        return redirect('inventario');
    }
}
