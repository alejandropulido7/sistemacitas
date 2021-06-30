<?php

namespace App\Http\Controllers;

use App\Usuarios;
use App\Roles;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datosUser['usuarios'] = Usuarios::paginate(10);
        return view('usuarios.index', $datosUser);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datosRoles = Roles::all();
        return view('usuarios.create', compact('datosRoles'));
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
        // $datosUsuario = request()-> all();
        $request->validate([
            'docUsuario' => 'required',
            'nombreCompleto' => 'required',
            'user' => 'required',
            'password' => 'required',
            'email' => 'required',
            'celular' => 'required',
            'estudiosUsuario' => 'required',
            'especialUsuario' => 'required',
            'estadoUsuario' => 'required'
        ]);

        $datosUsuario = request()->except("_token");

        if($request->hash_file('fotoUsuario'))
        {
            $datosUsuario['fotoUsuario']=$request->file('fotoUsuario')->store('uploads','public');
        }
        Usuarios::insert($datosUsuario);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function show(Usuarios $usuarios)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuarios $usuarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuarios $usuarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario->destroy($id);
        return redirect('usuarios');
    }
}
