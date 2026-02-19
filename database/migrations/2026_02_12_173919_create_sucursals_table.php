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
        Schema::create('sucursales', function (Blueprint $table) {
            $table->id('idsucursales');
            $table->foreign('usuario_creador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_creador_id')->nullable();
            $table->foreign('usuario_modificador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_modificador_id')->nullable();
            $table->foreign('usuario_eliminador_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_eliminador_id')->nullable();
            $table->unsignedBigInteger('empresas_idempresas');
            $table->string('nombre', 45);
            $table->string('codigo_sucursal', 45);
            $table->text('direccion')->nullable();
            $table->string('celular', 45)->nullable();
            $table->string('municipio', 45)->nullable();
            $table->string('estado', 45)->nullable();
            $table->timestamps();

            // Clave foránea
            $table->foreign('empresas_idempresas')
                ->references('idempresas')
                ->on('empresas');
                
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sucursales');
    }
};
