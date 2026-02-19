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
        Schema::create('evento_significativos', function (Blueprint $table) {
            $table->id('idevento_significativos');

            $table->unsignedBigInteger('empresas_idempresas');
            $table->foreign('empresas_idempresas')->references('idempresas')->on('empresas');
            $table->unsignedBigInteger('tipo_evento_significativos_idtipo_evento_significativos');
            $table->foreign('tipo_evento_significativos_idtipo_evento_significativos')->references('idtipo_evento_significativos')->on('tipo_evento_significativos');
            $table->unsignedBigInteger('punto_ventas_idpuntoventas')->nullable();
            $table->foreign('punto_ventas_idpuntoventas')->references('idpuntoventas')->on('punto_ventas');
            $table->unsignedBigInteger('sucursales_idsucursales');
            $table->foreign('sucursales_idsucursales')->references('idsucursales')->on('sucursales');
            $table->bigInteger('cufd_activo_id');
            #$table->foreign('cufd_activo_id')->references('id')->on('cufd_activo');
            $table->bigInteger('cufd_evento_id');
            #$table->foreign('cufd_evento_id')->references('id')->on('cufd_evento');
            $table->unsignedBigInteger('cuis_idcuis');
            $table->foreign('cuis_idcuis')->references('idcuis')->on('cuis');

            $table->string('descripcion');
            $table->dateTime('fecha_ini_evento');
            $table->dateTime('fecha_fin_evento');
            $table->string('codigoRecepcionEventoSignificativo',45);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evento_significativos');
    }
};
