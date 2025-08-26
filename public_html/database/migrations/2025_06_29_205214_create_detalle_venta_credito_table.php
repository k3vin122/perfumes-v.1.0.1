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
        Schema::create('detalle_venta_credito', function (Blueprint $table) {
         $table->id();
    $table->foreignId('venta_credito_id')->constrained('ventas_credito')->onDelete('cascade');
    $table->foreignId('producto_id')->constrained('productos');
    $table->integer('cantidad');
    $table->decimal('precio_unitario', 10, 2);
    $table->decimal('subtotal', 10, 2);
    $table->text('notas')->nullable();  // <-- campo notas no obligatorio

    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_venta_credito');
    }
};
