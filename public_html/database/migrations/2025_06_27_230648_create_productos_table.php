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
        Schema::create('productos', function (Blueprint $table) {
             $table->id();
        $table->string('sku')->unique();
        $table->string('marca');
        $table->string('producto');
        $table->enum('genero', ['Hombre', 'Mujer', 'Unisex']);
        $table->decimal('valor_compra', 10, 2);
        $table->decimal('valor_venta_sur', 10, 2);
        $table->decimal('valor_venta_norte', 10, 2);
        $table->decimal('ganancia_sur', 10, 2);
        $table->decimal('ganancia_norte', 10, 2);
        $table->string('imagen')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
