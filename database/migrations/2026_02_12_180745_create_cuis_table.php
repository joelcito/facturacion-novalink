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
        Schema::create('cuis', function (Blueprint $table) {
            $table->id('idcuis');
            #$table->foreign('usuario_creador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_creador_id')->nullable();
            $table->foreign('usuario_modificador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_modificador_id')->nullable();
            $table->foreign('usuario_eliminador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_eliminador_id')->nullable();
            $table->unsignedBigInteger('punto_ventas_idpuntoventas')->nullable();
            $table->unsignedBigInteger('sucursales_idsucursales');
    
            $table-> string('codigo');
            $table->dateTime('fechaVigencia');
            $table->string('codigo_ambiente')->nullable();
            $table->string('estado', 45)->nullable();
               
    
            // Relaciones
            $table->foreign('sucursales_idsucursales')
                  ->references('idsucursales')
                  ->on('sucursales')
                  ->onDelete('cascade');
    
            $table->foreign('punto_ventas_idpuntoventas')
                  ->references('idpuntoventas')
                  ->on('punto_ventas')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuis');
    }
};
