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
        Schema::create('facturas', function (Blueprint $table) {
            $table->string('factura_id', 60)->primary();
            $table->date('fecha_factura');
            $table->integer('num_cuotas')->default('0');;
            $table->decimal('saldo_pendiente', 10, 2);
            $table->string('concepto', 100)->nullable();
            $table->string('cliente_id', 60);
            $table->char('carta_notarial', 1)->default('0');
            $table->date('fecha_vencimiento');
            $table->string('descripcion', 200)->nullable();
            $table->string('servicio', 200)->nullable();
            $table->foreign('cliente_id')->references('cliente_id')->on('clientes');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
