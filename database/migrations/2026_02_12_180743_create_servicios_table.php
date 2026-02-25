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
        Schema::create('servicios', function (Blueprint $table) {
            $table->id('idservicios')->primary();

            $table->unsignedBigInteger('empresas_idempresas');
            $table->unsignedBigInteger('depende_actividades_iddepende_actividades');
            $table->unsignedBigInteger('producto_servicios_idproducto_servicios');
            $table->unsignedBigInteger('unidad_medidas_idunidad_medidas');
            $table->unsignedBigInteger('tipo_documento_sectores_idtipo_documento_sectores');
    
            $table->string('descripcion');
            $table->decimal('precio', 12, 2);
            $table->decimal('precio_compra', 12, 2);    
            $table->string('numero_serie', 45)->nullable();
            $table->string('codigo_imei', 45)->nullable();
            $table->string('tipo',10)->nullable();
            $table->string('imagen',255)->nullable();
            $table->string('estado',45);

            $table->unsignedBigInteger('usuario_creador_id');
            $table->foreign('usuario_creador_id')->references('idusers')->on('users');
            $table->unsignedBigInteger('usuario_modificador_id')->nullable()->after('usuario_creador_id');
            $table->foreign('usuario_modificador_id')->references('idusers')->on('users');
            $table->unsignedBigInteger('usuario_eliminador_id')->nullable()->after('usuario_modificador_id');
            $table->foreign('usuario_eliminador_id')->references('idusers')->on('users');
            $table->integer('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
            // Relaciones
            $table->foreign('empresas_idempresas')->references('idempresas')->on('empresas');    
            $table->foreign('depende_actividades_iddepende_actividades')->references('iddepende_actividades')->on('depende_actividades');
            $table->foreign('producto_servicios_idproducto_servicios')->references('idproducto_servicios')->on('producto_servicios');
            $table->foreign('unidad_medidas_idunidad_medidas')->references('idunidad_medidas')->on('unidad_medidas');
            $table->foreign('tipo_documento_sectores_idtipo_documento_sectores')->references('idtipo_documento_sectores')->on('tipo_documento_sectores');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
