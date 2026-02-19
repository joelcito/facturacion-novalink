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
        Schema::create('depende_actividades', function (Blueprint $table) {
            $table->id('iddepende_actividades');

            $table->unsignedBigInteger('empresas_idempresas'); // si depende de una empresa
            $table->string('codigo_ambiente', 45);
            $table->string('codigo_caeb', 45);           
            $table->string('descripcion', 255)->nullable();
            $table->string('tipo_actividad', 255);

            $table->timestamps();

            // Relación con Empresa
            $table->foreign('empresas_idempresas')
                ->references('idempresas')
                ->on('empresas')
                ->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depende_actividades');
    }
};
