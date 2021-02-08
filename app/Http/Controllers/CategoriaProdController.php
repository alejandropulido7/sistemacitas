<?php

namespace App\Http\Controllers;

use App\CategoriaProd;
use Illuminate\Http\Request;

class CategoriaProdController extends Controller
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
        //
        $datosCategorias = request()->except('_token');
        CategoriaProd::insert($datosCategorias);
        return redirect('inventario');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CategoriaProd  $categoriaProd
     * @return \Illuminate\Http\Response
     */
    public function show(CategoriaProd $categoriaProd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CategoriaProd  $categoriaProd
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriaProd $categoriaProd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CategoriaProd  $categoriaProd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoriaProd $categoriaProd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CategoriaProd  $categoriaProd
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoriaProd $categoriaProd)
    {
        //
    }
}
