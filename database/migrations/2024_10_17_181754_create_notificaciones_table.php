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
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->id('notificacion_id');
            $table->unsignedBigInteger('periodo_id');
            $table->string('factura_id', 60);
            $table->unsignedBigInteger('asunto_id');
            $table->string('mensaje', 500);
            $table->date('fecha');
        
            $table->foreign(['periodo_id', 'factura_id'])->references(['periodo_id', 'factura_id'])->on('periodos');
            $table->foreign('asunto_id')->references('asunto_id')->on('asunto_notificacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificaciones');
    }
};
