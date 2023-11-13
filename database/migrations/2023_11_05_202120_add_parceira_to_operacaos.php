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
        Schema::table('operacaos', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Parceira::class,'parceira_id');
            $table->foreignIdFor(\App\Models\Extrato::class,'extrato_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('operacaos', function (Blueprint $table) {
            $table->dropColumn('parceira_id');
            $table->dropColumn('extrato_id');
        });
    }
};
