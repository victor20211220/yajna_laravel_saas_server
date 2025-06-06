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
        if (!Schema::hasTable('card_app_infos')) {
        Schema::create('card_app_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('business_id')->nullable();
            $table->text('playstore_id')->nullable();
            $table->text('appstore_id')->nullable();
            $table->text('variant')->nullable();
            $table->integer('is_enabled')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
        });
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apps_info');
    }
};
