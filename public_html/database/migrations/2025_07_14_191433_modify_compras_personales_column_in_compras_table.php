<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::table('compras', function (Blueprint $table) {
        $table->decimal('compras_personales', 10, 2)->nullable()->change();
    });
}

    /**
     * Reverse the migrations.
     */
   public function down()
{
    Schema::table('compras', function (Blueprint $table) {
        // Pon aquí la definición anterior
        $table->boolean('compras_personales')->nullable()->change();
    });
}
};