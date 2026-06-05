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
        Schema::create('kpr_promos', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->decimal('bunga_fix', 5, 2);
            $table->integer('masa_fix');
            $table->decimal('bunga_floating', 5, 2);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpr_promos');
    }
};
