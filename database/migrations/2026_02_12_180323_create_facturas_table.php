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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id('idfacturas');

        $table->unsignedBigInteger('clientes_idclientes');
        $table->unsignedBigInteger('empresas_idempresas');
        $table->unsignedBigInteger('sucursales_idsucursales');
        $table->unsignedBigInteger('punto_ventas_idpuntoventas')->nullable();
        $table->unsignedBigInteger('motivo_anulaciones_idmotivo_anulaciones');
        $table->unsignedBigInteger('tipo_documento_identidades_idtipo_documento_identidades');

        $table->dateTime('fecha');
        $table->string('nit', 45);
        $table->string('razon_social', 45);
        $table->string('numero_factura', 45);
        $table->string('numero_cafc', 45);                
        $table->decimal('monto_total', 12, 2);
        $table->decimal('monto_total_sujeto_iva', 12, 2)->nullable();
        $table->decimal('descuento_adicional', 12, 2)->nullable();
        $table->string('cuf')->nullable();
        $table->string('producto_xml');
        $table->string('codigo_descripcion',45);
        $table->string('codigo_recepcion',45);
        $table->string('codigo_transaccion',45);
        $table->string('descripcion',255);
        $table->string('tipo_factura',45);
        $table->string('uso_cafc',255);
        $table->decimal('monto_gift_card', 12, 2)->nullable();

        
        $table->timestamps();

        // Relaciones
        $table->foreign('clientes_idclientes')->references('idclientes')->on('clientes');
        $table->foreign('empresas_idempresas')->references('idempresas')->on('empresas');
        $table->foreign('sucursales_idsucursales')->references('idsucursales')->on('sucursales');
        $table->foreign('punto_ventas_idpuntoventas')->references('idpuntoventas')->on('punto_ventas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
