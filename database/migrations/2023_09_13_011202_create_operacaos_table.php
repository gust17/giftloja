<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('operacaos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Cliente::class,'cliente_id');
            $table->string('code');
            $table->float('valor');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operacaos');
    }
};
