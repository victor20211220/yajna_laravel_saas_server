<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'google2fa_enable'))
        {
            Schema::table('users', function (Blueprint $table) {
                $table->integer('google2fa_enable')->default(0)->after('is_enable_login');
                $table->text('google2fa_secret')->nullable()->after('is_enable_login');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {

        });
    }
};
