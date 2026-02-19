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
            $table->id('idservicios');

            $table->unsignedBigInteger('empresas_idempresas');
            $table->unsignedBigInteger('depende_actividades_iddepende_actividades');
            $table->unsignedBigInteger('producto_servicios_idproducto_servicios');
            $table->unsignedBigInteger('unidad_medidas_idunidad_medidas');
            $table->unsignedBigInteger('tipo_documento_sectores_idtipo_documento_sectores');
    
            $table->string('descripcion');
            $table->decimal('precio', 12, 2);    
            $table->string('numero_serie', 45)->nullable();
            $table->string('codigo_imei', 45)->nullable();
        
            // Relaciones
            $table->foreign('empresas_idempresas')
                  ->references('idempresas')
                  ->on('empresas');
    
            $table->foreign('depende_actividades_iddepende_actividades')
                  ->references('iddepende_actividades')
                  ->on('depende_actividades');
    
               
           
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
