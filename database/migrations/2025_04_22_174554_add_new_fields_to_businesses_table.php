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
        Schema::table('businesses', function (Blueprint $table) {
             $table->text('company_logo')->nullable();

             $table->string('phone')->nullable();
             $table->string('address')->nullable();
             $table->string('email')->nullable();
             $table->string('website')->nullable();

             $table->string('card_bg_color')->nullable();
             $table->string('button_bg_color')->nullable();
             $table->string('card_text_color')->nullable();
             $table->string('button_text_color')->nullable();

             $table->text('google_review_link')->nullable();
             $table->integer('google_review_enabled')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
             $table->dropColumn(['company_logo', 'phone', 'address', 'email', 'website', 'card_bg_color', 'button_bg_color', 'card_text_color', 'button_text_color', 'google_review_link', 'google_review_enabled']);
        });
    }
};
