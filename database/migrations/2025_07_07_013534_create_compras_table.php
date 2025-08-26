<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->string('numero_boleta');
            $table->string('numero_orden_compra')->nullable();
            $table->date('fecha');
            $table->string('tienda');
            $table->decimal('monto_comprado', 10, 2);
            $table->decimal('valor_despacho', 10, 2)->nullable();
            $table->decimal('total', 10, 2); // monto_comprado + valor_despacho
            $table->string('archivo_boleta')->nullable(); // PDF o imagen
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
