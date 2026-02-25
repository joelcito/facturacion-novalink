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
        Schema::create('producto_servicios', function (Blueprint $table) {
            
            $table->id('idproducto_servicios')->primary();

            $table->unsignedBigInteger('empresas_idempresas');
            $table->unsignedBigInteger('sucursales_idsucursales')->nullable();
            $table->unsignedBigInteger('punto_ventas_idpuntoventas')->nullable();

            $table->string('codigo_ambiente', 45);
            $table->string('numero_serie',45);
            $table->string('codigo_imei', 45);
            $table->string('codigo_actividad', 45);
            $table->string('codigo_producto', 45);
            $table->string('descripcion_producto', 255)->nullable();
            $table->string('nandina_pri', 45);
            $table->string('nandina_seg', 45);
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
        Schema::dropIfExists('producto_servicios');
    }
};
