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
        Schema::create('waste_transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tps_id')->constrained('tps_tpa');
            $table->foreignId('tpa_id')->constrained('tps_tpa');
            $table->decimal('waste_amount', 10, 2);
            $table->string('waste_type');
            $table->dateTime('transfer_date');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waste_transfers');
    }
};