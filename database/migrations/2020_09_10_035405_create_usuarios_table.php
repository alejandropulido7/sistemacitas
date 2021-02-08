<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('docUsuario');
            $table->string('nombreCompleto');
            $table->string('user');
            $table->string('password');
            $table->string('email');
            $table->string('celular');
            $table->enum('enLinea', ["1", "0"]);
            $table->string('estudiosUsuario');
            $table->string('especialUsuario');
            $table->enum('estadoUsuario', ["activo", "inactivo"]);
            $table->string('fotoUsuario')->nullable();
            $table->unsignedInteger('idRol');
            $table->foreign('idRol')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade')
                ->onUpdate('cascade');  
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
