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
        Schema::create('detalles', function (Blueprint $table) {
            $table->id('iddetalles');

            $table->unsignedBigInteger('empresas_idempresas');
            $table->unsignedBigInteger('sucursales_idsucursales');
            $table->unsignedBigInteger('punto_ventas_idpuntoventas');
            $table->unsignedBigInteger('facturas_idfacturas');
            $table->unsignedBigInteger('clientes_idclientes');
            $table->unsignedBigInteger('servicios_idservicios');

            $table->string('descripcion_adicional');
            $table->string('numero_serie');
            $table->string('numero_imei');
            $table->decimal('precio', 12, 2);
            $table->decimal('cantidad', 12, 2);
            $table->decimal('total', 12, 2);
            $table->decimal('descuento', 12, 2)->default(0);
            $table->decimal('importe', 12, 2)->default(0);
            $table->datetime('fecha');
            $table->string('detallescol',45);
            
            $table->foreign('facturas_idfacturas')
                ->references('idfacturas')
                ->on('facturas');

            $table->foreign('servicios_idservicios')
                ->references('idservicios')
                ->on('servicios');
            
            $table->foreign('clientes_idclientes')
                ->references('idclientes')
                ->on('clientes');

            $table->foreign('punto_ventas_idpuntoventas')
                ->references('idpuntoventas')
                ->on('punto_ventas');
            $table->foreign('sucursales_idsucursales')->references('idsucursales')->on('sucursales');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles');
    }
};
