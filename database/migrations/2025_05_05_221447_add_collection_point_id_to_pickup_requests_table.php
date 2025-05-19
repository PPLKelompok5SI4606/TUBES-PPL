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
        // Schema::table('pickup_requests', function (Blueprint $table) {
        //     $table->unsignedBigInteger('collection_point_id')->nullable()->after('user_id');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pickup_requests', function (Blueprint $table) {
            $table->dropColumn('collection_point_id');
        });
    }
};
