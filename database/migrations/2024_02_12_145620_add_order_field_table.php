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
        Schema::table('plan_orders', function (Blueprint $table) {
            if (!Schema::hasColumn('plan_orders', 'is_refund')) {
                $table->integer('is_refund')->default(0)->after('payment_type');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plan_orders', function (Blueprint $table) {
            if (Schema::hasColumn('plan_orders', 'is_refund')) {
                $table->dropColumn('is_refund');
            }
        });
    }
};
