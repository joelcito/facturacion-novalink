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
        Schema::create('tipo_documento_sectores', function (Blueprint $table) {
            $table->id('idtipo_documento_sectores');

            $table->string('codigo_clasificador', 45);
            $table->string('descripcion', 255);            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_documento_sectores');
    }
};
