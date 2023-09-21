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
            $table->tinyInteger('status')->default(0);
            $table->dateTime('data_recebimento')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('saques', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('data_recebimento');
        });
    }
};
