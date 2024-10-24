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
        Schema::create('periodos', function (Blueprint $table) {
            $table->id('periodo_id'); // Utiliza AUTO_INCREMENT automáticamente
            $table->decimal('monto', 10, 2);
            $table->integer('numero');
            $table->date('fecha_vencimiento')->notNullable();
            $table->string('status', 30)->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->date('fecha_pagado')->nullable();
            $table->string('factura_id', 60); // Asegúrate de que coincida con la longitud en FACTURAS

            // Clave primaria compuesta
            $table->primary(['periodo_id', 'factura_id']);
            
            // Claves foráneas
            $table->foreign('area_id')->references('area_id')->on('areas');
            $table->foreign('factura_id')->references('factura_id')->on('facturas')->onDelete('cascade'); // Asegúrate de que la tabla FACTURAS exista

            $table->timestamps(); // Para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodos');
    }
};
