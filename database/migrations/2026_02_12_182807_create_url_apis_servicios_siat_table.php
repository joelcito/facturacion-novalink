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
        Schema::create('url_apis_servicios_siat', function (Blueprint $table) {
            $table->id('idurl_apis_servicios_siat');

            $table->unsignedBigInteger('tipo_documento_sectores_idtipo_documento_sectores');

            $table->string('ambiente', 45);
            $table->string('modalidad', 45);
            $table->string('nombre', 45);
            $table->string('url_servicio');

            $table->timestamps();

            $table->foreign('tipo_documento_sectores_idtipo_documento_sectores')
                ->references('idtipo_documento_sectores')
                ->on('tipo_documento_sectores')
                ->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('url_apis_servicios_siat');
    }
};
