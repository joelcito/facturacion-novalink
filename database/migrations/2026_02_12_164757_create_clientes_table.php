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
            $table->id('idclientes')->primary();
                       
            $table->unsignedBigInteger('empresas_idempresas')->after('idclientes');
            $table->foreign('empresas_idempresas')->references('idempresas')->on('empresas');
            $table->string('nombres', 45);
            $table->string('ap_paterno', 45);
            $table->string('ap_materno', 45)->nullable();
            $table->string('cedula', 45)->nullable();
            $table->string('complemento', 45)->nullable();
            $table->string('nit', 45)->nullable();
            $table->Text('razon_social')->nullable();
            $table->string('correo', 45)->nullable();
            $table->string('numero_celular', 45)->nullable();
            $table->string('estado', 45)->nullable();
           
            $table->unsignedBigInteger('usuario_creador_id');
            $table->foreign('usuario_creador_id')->references('idusers')->on('users');
            $table->unsignedBigInteger('usuario_modificador_id')->nullable()->after('usuario_creador_id');
            $table->foreign('usuario_modificador_id')->references('idusers')->on('users');
            $table->unsignedBigInteger('usuario_eliminador_id')->nullable()->after('usuario_modificador_id');
            $table->foreign('usuario_eliminador_id')->references('idusers')->on('users');
            $table->integer('created_at');
            $table->dateTime('modified_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
    
           
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
