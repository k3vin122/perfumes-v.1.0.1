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
    Schema::table('ventas', function (Blueprint $table) {
        $table->foreignId('venta_cabecera_id')->nullable()->after('id')->constrained('ventas_cabecera')->nullOnDelete();
    });
}
    /**
     * Reverse the migrations.
     */
   public function down()
{
    Schema::table('ventas', function (Blueprint $table) {
        $table->dropForeign(['venta_cabecera_id']);
        $table->dropColumn('venta_cabecera_id');
    });
}
};
