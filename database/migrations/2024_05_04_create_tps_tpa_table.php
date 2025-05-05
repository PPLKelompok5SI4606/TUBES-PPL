<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tps_tpa', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('tipe', ['TPS', 'TPA']);
            $table->decimal('kapasitas_total', 10, 2);
            $table->decimal('kapasitas_terisi', 10, 2);
            $table->string('lokasi');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tps_tpa');
    }
}; 