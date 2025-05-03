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
            $table->decimal('amount_kg', 8, 2);
            $table->string('location');
            $table->string('type'); // Add type field
            $table->enum('status', [
                'pending',    // Laporan baru, menunggu penanganan
                'in_progress', // Laporan sedang ditangani
                'resolved'    // Laporan telah selesai ditangani
            ])->default('pending');
            $table->date('collection_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('waste_collections');
    }
};