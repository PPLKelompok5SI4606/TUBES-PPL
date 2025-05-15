<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pickup_requests', function (Blueprint $table) {
            // Check if column exists before adding
            if (!Schema::hasColumn('pickup_requests', 'collection_point_id')) {
                $table->unsignedBigInteger('collection_point_id')->nullable();
                $table->foreign('collection_point_id')
                    ->references('id')
                    ->on('collection_points')
                    ->onDelete('set null');
            }
        });
    }

    public function down()
    {
        Schema::table('pickup_requests', function (Blueprint $table) {
            $table->dropForeign(['collection_point_id']);
            $table->dropColumn('collection_point_id');
        });
    }
};
