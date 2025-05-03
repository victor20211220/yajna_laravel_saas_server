<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('share_contact_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_id')->unique();
            $table->boolean('is_name_required')->default(true);
            $table->boolean('is_name_enabled')->default(true);
            $table->boolean('is_phone_required')->default(true);
            $table->boolean('is_phone_enabled')->default(true);
            $table->boolean('is_email_required')->default(false);
            $table->boolean('is_email_enabled')->default(false);
            $table->boolean('is_company_required')->default(false);
            $table->boolean('is_company_enabled')->default(false);
            $table->boolean('is_job_title_required')->default(false);
            $table->boolean('is_job_title_enabled')->default(false);
            $table->boolean('is_notes_required')->default(false);
            $table->boolean('is_notes_enabled')->default(false);
            $table->timestamps();
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('share_contact_fields');
    }
};
