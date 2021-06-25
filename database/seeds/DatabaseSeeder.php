<?php

use Illuminate\Database\Seeder;
use App\roles;
use App\Usuarios;
use App\Clientes;
use App\Productos;
use App\CategoriaProd;
use App\Actividades;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $rol = new Roles();
        $rol->nombreRol = 'Admin';
        $rol->descripcionRol = 'Administrador del sistema';
        $rol->save();

        $rol2 = new Roles();
        $rol2->nombreRol = 'User';
        $rol2->descripcionRol = 'Usuario del sistema';
        $rol2->save();

        $usuario = new Usuarios();
        $usuario->docUsuario = '102020202';
        $usuario->nombreCompleto = 'Alejandro Pulido';
        $usuario->user = 'hapulido22';
        $usuario->password = Hash::make('12345678');
        $usuario->email = 'hapulido22@gmail.com';
        $usuario->celular = '3013131311';
        $usuario->estudiosUsuario = 'Uñas';
        $usuario->especialUsuario = 'Pies';
        $usuario->idRol = 1;
        $usuario->save();

        $usuarios = factory(Usuarios::class,3)->create();
        $clientes = factory(Clientes::class,10)->create();
        $categoria = factory(CategoriaProd::class,5)->create();
        $actividades = factory(Actividades::class,5)->create();
        $productos = factory(Productos::class,6)->create();
    }
}
