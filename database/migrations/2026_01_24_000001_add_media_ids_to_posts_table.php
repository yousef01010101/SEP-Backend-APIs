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
        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId('image_id')->nullable()->after('topic_id')->constrained('images')->onDelete('set null');
            $table->foreignId('video_id')->nullable()->after('image_id')->constrained('videos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['image_id']);
            $table->dropForeign(['video_id']);
            $table->dropColumn(['image_id', 'video_id']);
        });
    }
};
