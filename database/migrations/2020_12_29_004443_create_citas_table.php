<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',255);
            $table->dateTime('start');
            $table->string('backgroundColor',20);
            $table->timestamp('duracionCita');
            $table->unsignedInteger('idEstado');
            $table->foreign('idEstado')
                  ->references('id')
                  ->on('estado_citas')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->unsignedInteger('idActividad');
            $table->foreign('idActividad')
                  ->references('id')
                  ->on('actividades')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->unsignedInteger('idUsuario');
            $table->foreign('idUsuario')
                  ->references('id')
                  ->on('usuarios')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->unsignedInteger('idCliente');
            $table->foreign('idCliente')
                  ->references('id')
                  ->on('clientes')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');      
            $table->string('detalleCita')->nullable();     
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
        Schema::dropIfExists('citas');
    }
}
