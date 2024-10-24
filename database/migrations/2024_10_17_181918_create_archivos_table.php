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
        Schema::create('archivos', function (Blueprint $table) {
            $table->id('archivo_id');
            $table->string('nombre', 300);
            $table->unsignedBigInteger('periodo_id');
            $table->string('factura_id', 60);
            $table->unsignedBigInteger('notificacion_id');
        
            $table->foreign(['periodo_id', 'factura_id', 'notificacion_id'])->references(['periodo_id', 'factura_id', 'notificacion_id'])->on('notificaciones');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archivos');
    }
};
