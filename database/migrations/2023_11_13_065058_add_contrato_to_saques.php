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
        Schema::table('saques', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Contrato::class,'contrato_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('saques', function (Blueprint $table) {
            $table->dropColumn('contrato_id');
        });
    }
};
