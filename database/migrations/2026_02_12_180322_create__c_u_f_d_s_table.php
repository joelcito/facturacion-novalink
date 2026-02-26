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
        
            $table->id('idcufds')->primary();
            $table->unsignedBigInteger('empresas_idempresas');
            $table->unsignedBigInteger('sucursales_idsucursales');
            $table->unsignedBigInteger('punto_ventas_idpuntoventas')->nullable();
            $table->unsignedBigInteger('cuis_idcuis');

            $table->string('codigo_ambiente',45);
            $table->string('codigo',45);            
            $table->string('codigo_control',45);
            $table->string('direccion');
            $table->dateTime('fecha_vigencia');
            $table->string('cufdscol',45);


            $table->string('estado', 45)->nullable();
            
            $table->unsignedBigInteger('usuario_creador_id');
            $table->foreign('usuario_creador_id')->references('idusers')->on('users');
            $table->unsignedBigInteger('usuario_modificador_id')->nullable()->after('usuario_creador_id');
            $table->foreign('usuario_modificador_id')->references('idusers')->on('users');
            $table->unsignedBigInteger('usuario_eliminador_id')->nullable()->after('usuario_modificador_id');
            $table->foreign('usuario_eliminador_id')->references('idusers')->on('users');
            $table->integer('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();

            $table->foreign('empresas_idempresas')->references('idempresas')->on('empresas');            
            $table->foreign('sucursales_idsucursales')->references('idsucursales')->on('sucursales');
            $table->foreign('punto_ventas_idpuntoventas')->references('idpuntoventas')->on('punto_ventas');
            $table->foreign('cuis_idcuis')->references('idcuis')->on('cuis');
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
