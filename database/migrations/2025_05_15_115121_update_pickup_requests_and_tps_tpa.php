<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePickupRequestsAndTpsTpa extends Migration
{
    public function up()
    {
        // Add tps_tpa_id to pickup_requests table
        Schema::table('pickup_requests', function (Blueprint $table) {
            $table->foreignId('tps_tpa_id')->nullable()->constrained('tps_tpa')->nullOnDelete();
            $table->decimal('waste_volume_m3', 10, 2)->nullable()->comment('Waste volume in cubic meters');
        });

        // Add capacity fields to tps_tpa table if they don't exist
        if (!Schema::hasColumn('tps_tpa', 'current_capacity')) {
            Schema::table('tps_tpa', function (Blueprint $table) {
                $table->decimal('current_capacity', 10, 2)->default(0)->comment('Current waste capacity in cubic meters');
                $table->decimal('max_capacity', 10, 2)->default(100)->comment('Maximum waste capacity in cubic meters');
            });
        }
    }

    public function down()
    {
        Schema::table('pickup_requests', function (Blueprint $table) {
            $table->dropForeign(['tps_tpa_id']);
            $table->dropColumn(['tps_tpa_id', 'waste_volume_m3']);
        });

        if (Schema::hasColumn('tps_tpa', 'current_capacity')) {
            Schema::table('tps_tpa', function (Blueprint $table) {
                $table->dropColumn(['current_capacity', 'max_capacity']);
            });
        }
    }
}