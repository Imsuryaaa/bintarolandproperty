<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('condition_property', function (Blueprint $table) {
            $table->id();
            $table->foreignId('condition_id')
                ->constrained('conditions')
                ->onDelete('cascade');
            $table->foreignId('property_id')
                ->constrained('properties')
                ->onDelete('cascade');
            $table->timestamps();
            
            // Prevent duplicate relationships
            $table->unique(['condition_id', 'property_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('condition_property');
    }
};
