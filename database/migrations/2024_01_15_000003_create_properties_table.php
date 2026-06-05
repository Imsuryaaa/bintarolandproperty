<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('property_code')->unique();
            $table->string('property_type')->default('rumah');
            $table->string('property_condition')->default('baru'); // baru | second | aset-bank
            $table->string('title');
            $table->string('slug')->unique();
            $table->decimal('price', 20, 2);
            $table->text('description');
            $table->unsignedInteger('bedrooms')->default(0);
            $table->unsignedInteger('bathrooms')->default(0);
            $table->unsignedInteger('floors')->default(1);
            $table->unsignedInteger('garages')->default(0);
            $table->unsignedInteger('carports')->default(0);
            $table->unsignedInteger('land_area')->default(0);
            $table->unsignedInteger('build_area')->default(0);
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('complex_name')->nullable();
            $table->string('street_name')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            
            // Indexes for better query performance
            $table->index('slug');
            $table->index('price');
            $table->index('is_featured');
            $table->index('property_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
