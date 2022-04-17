<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transferencias', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('idTransacción');
            $table->string('requerimientoFuente');
            $table->string('nombreUsuario');
            $table->string('celularEmisor');
            $table->string('celularDestinatario');
            $table->string('indentificaiconCliente');
            $table->string('claseServicio');
            $table->string('subServicio');
            $table->string('transferenciaFechaHora');
            $table->string('montoRequerimiento');
            $table->string('montoCredito');
            $table->string('bono');
            $table->string('horariosProcesamiento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transferencias');
    }
};