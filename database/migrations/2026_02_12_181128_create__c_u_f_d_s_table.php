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
        Schema::create('CUFDS', function (Blueprint $table) {
        
            $table->id('idcufds');
            $table->unsignedBigInteger('empresas_idempresas');
            $table->unsignedBigInteger('sucursales_idsucursales');
            $table->unsignedBigInteger('punto_ventas_idpuntoventas')->nullable();

            $table->string('codigo_ambiente',45);
            $table->string('nombre',45);
            $table->string('codigo_control',45);
            $table->string('direccion');
            $table->dateTime('fecha_vigencia');
            $table->string('cufdscol',45);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('CUFDS');
    }
};
