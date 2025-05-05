<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pickup_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('address');
            $table->text('description');
            $table->enum('status', ['pending', 'accepted', 'rejected', 'completed'])->default('pending');
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('pickup_time')->nullable();
            $table->timestamps();
        });

        Schema::table('pickup_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('collection_point_id')->nullable()->after('user_id');
            // Jika ingin relasi foreign key:
            // $table->foreign('collection_point_id')->references('id')->on('collection_points')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pickup_requests');

        Schema::table('pickup_requests', function (Blueprint $table) {
            $table->dropColumn('collection_point_id');
        });
    }
}; 