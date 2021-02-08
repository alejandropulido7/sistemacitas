<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionProdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion_prods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidadAsignada');
            $table->string('detalleAsignacion');
            $table->unsignedInteger('idInventario');
            $table->foreign('idInventario')
                ->references('id')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->on('inventarios');
            $table->unsignedInteger('idUsuario');
            $table->foreign('idUsuario')
                ->references('id')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->on('usuarios');    
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
        Schema::dropIfExists('asignacion_prods');
    }
}
