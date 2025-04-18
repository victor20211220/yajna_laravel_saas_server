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
        if (Schema::hasTable('businesses')) {
        Schema::table('businesses', function (Blueprint $table) {
            $table->string('theme')->nullable()->default('theme1')->after('slug');
            $table->string('is_svg_enabled')->nullable()->after('google_map_link');
            $table->text('svg_text')->nullable()->after('is_svg_enabled');
        });
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('businesses')) {
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropColumn(['theme','is_svg_enabled', 'svg_text']);
        });
    }
    }
};
