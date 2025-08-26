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
        Schema::create('dinerobanco', function (Blueprint $table) {
            $table->id();
            $table->decimal('dinero', 10, 2);  // Guardamos como decimal, con 10 dígitos en total y 2 después del punto decimal
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dinerobanco');
    }
};
