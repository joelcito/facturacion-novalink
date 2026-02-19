<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('idclientes');
            $table->foreign('usuario_creador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_creador_id')->nullable();
            $table->foreign('usuario_modificador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_modificador_id')->nullable();
            $table->foreign('usuario_eliminador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_eliminador_id')->nullable();
            $table->unsignedBigInteger('empresas_idempresas')->after('id');
            // Clave foránea (si tienes tabla empresas)
            $table->foreign('empresas_idempresas')->references('idempresas')->on('empresas');
            $table->string('nombres', 45);
            $table->string('ap_paterno', 45);
            $table->string('ap_materno', 45)->nullable();
            $table->string('cedula', 45)->nullable();
            $table->string('complemento', 45)->nullable();
            $table->string('nit', 45)->nullable();
            $table->string('razon_social', 45)->nullable();
            $table->string('correo', 45)->nullable();
            $table->string('numero_celular', 45)->nullable();
            $table->string('estado', 45)->nullable();
    
           
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
