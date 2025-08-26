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
        Schema::create('ventas_credito', function (Blueprint $table) {
         $table->id();
    $table->string('cliente_nombre');
    $table->date('fecha');
    $table->enum('zona', ['Norte', 'Sur']);
    $table->integer('cuotas');
    $table->decimal('interes', 5, 2)->default(3.00);
    $table->decimal('abono_inicial', 10, 2)->default(0);
    $table->decimal('total', 10, 2);
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas_creditos');
    }
};
