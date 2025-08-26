<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::table('ventas_credito', function (Blueprint $table) {
            $table->text('notas')->nullable()->after('total');
        });
    }

    public function down()
    {
        Schema::table('ventas_credito', function (Blueprint $table) {
            $table->dropColumn('notas');
        });
    }
};