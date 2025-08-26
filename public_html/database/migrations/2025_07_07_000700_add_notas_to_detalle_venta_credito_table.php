<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
{
    Schema::table('detalle_venta_credito', function (Blueprint $table) {
        $table->text('notas')->nullable()->after('subtotal'); // agrega columna notas después de subtotal
    });
}

public function down(): void
{
    Schema::table('detalle_venta_credito', function (Blueprint $table) {
        $table->dropColumn('notas');
    });
}
};