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
        Schema::create('coment_periodo', function (Blueprint $table) {
            $table->id('com_periodo_id');
            $table->unsignedBigInteger('periodo_id');
            $table->string('factura_id', 60);
            $table->string('description', 500);
            $table->string('usuario', 200);
            $table->date('fecha');
        
            $table->foreign(['periodo_id', 'factura_id'])->references(['periodo_id', 'factura_id'])->on('periodos');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coment_periodo');
    }
};
