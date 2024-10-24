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
        Schema::create('contactos', function (Blueprint $table) {
            $table->id('contacto_id');
            $table->string('correo', 100)->nullable();
            $table->string('nombre', 100)->nullable();
            $table->string('factura_id', 60);
        
            $table->foreign('factura_id')->references('factura_id')->on('facturas');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contactos');
    }
};
