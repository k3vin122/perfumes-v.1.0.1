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
        Schema::create('pagos_ventas_credito', function (Blueprint $table) {
        $table->id();
        $table->foreignId('venta_credito_id')->constrained('ventas_credito')->onDelete('cascade');
        $table->date('fecha_pago');
        $table->decimal('monto', 10, 2);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos_ventas_credito');
    }
};
