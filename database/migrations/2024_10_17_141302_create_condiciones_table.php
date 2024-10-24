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
        Schema::create('condiciones', function (Blueprint $table) {
            $table->id('condicion_id');
            $table->string('status', 30);
            $table->integer('num_periodos')->nullable();
            $table->string('condicion', 60)->nullable();
            $table->string('factura_id', 60);
            $table->date('fecha_registro');
        
            $table->foreign('factura_id')->references('factura_id')->on('facturas');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('condiciones');
    }
};
