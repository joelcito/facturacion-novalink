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
        Schema::create('punto_ventas', function (Blueprint $table) {
            $table->id("idpuntoventas")->primary(); // id BIGINT automático        
            $table->unsignedBigInteger('sucursals_idsucursales');
            $table->foreign('sucursals_idsucursales')->references('idsucursales')->on('sucursales');

            $table->string('codigoPuntoVenta', 255)->nullable();
            $table->string('nombrePuntoVenta', 255)->nullable();
            $table->string('tipoPuntoVenta', 255)->nullable();
            $table->string('codigo_ambiente', 255)->nullable();
            $table->string('estado',45)->nullable();

            $table->unsignedBigInteger('usuario_creador_id');
            $table->foreign('usuario_creador_id')->references('idusers')->on('users');
            $table->unsignedBigInteger('usuario_modificador_id')->nullable()->after('usuario_creador_id');
            $table->foreign('usuario_modificador_id')->references('idusers')->on('users');
            $table->unsignedBigInteger('usuario_eliminador_id')->nullable()->after('usuario_modificador_id');
            $table->foreign('usuario_eliminador_id')->references('idusers')->on('users');
            $table->integer('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
            
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('punto_ventas');
    }
};
