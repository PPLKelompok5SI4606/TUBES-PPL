<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('waste_collections', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount_kg', 8, 2); // Amount of waste in kilograms
            $table->string('location'); // Disposal location
            $table->date('collection_date'); // Date of collection
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('waste_collections');
    }
};