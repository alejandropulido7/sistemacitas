<?php

namespace App\Http\Controllers;

use App\Citas;
use App\Usuarios;
use App\Actividades;
use App\Clientes;
use App\EstadoCitas;
use Illuminate\Http\Request;

class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datosUsuario = Usuarios::all();
        $datosCliente = Clientes::all();
        $datosActividades = Actividades::all();
        $datosEstados = EstadoCitas::all();
        return view('citas.index',compact('datosUsuario','datosCliente','datosActividades','datosEstados'));
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
        $datosCitas = request()->except("_token","_method");
        Citas::insert($datosCitas);
        // return redirect('citas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Citas  $citas
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $dataCitas['eventos'] = Citas::all();
        return response()->json($dataCitas['eventos']);
        
    }

    public function nombreCliente(request $request){
        $nombreCliente = Clientes::where("id","=", $request->id)->take(1)->get();
        return response()->json($nombreCliente);

    }


    public function buscarCliente(request $request) //Request $request
    {
        //
        $cliente = Clientes::where("nombreCliente","like", $request->texto."%")->take(10)->get();
        return response()->json($cliente);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Citas  $citas
     * @return \Illuminate\Http\Response
     */
    public function edit(Citas $citas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Citas  $citas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $citas = request()->except("_token","_method");
        Citas::where('id','=',$id)->update($citas);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Citas  $citas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $citas = Citas::findOrFail($id);
        Citas::destroy($id);
        return response()->json($id);
    }
}
