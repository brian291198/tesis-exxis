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
        Schema::create('coment_factura', function (Blueprint $table) {
            $table->id('com_factura_id');
            $table->string('factura_id', 60);
            $table->string('description', 500);
            $table->string('usuario', 200);
            $table->date('fecha');
        
            $table->foreign('factura_id')->references('factura_id')->on('facturas');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coment_factura');
    }
};
