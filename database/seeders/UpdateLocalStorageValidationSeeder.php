<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateLocalStorageValidationSeeder extends Seeder
{
    public function run()
    {
        DB::table('settings')
            ->where('name', 'local_storage_validation')
            ->update([
                'value' => 'csv,jpeg,jpg,pdf,png,xls,xlsx,mp4,webm',
                'updated_at' => now(),
            ]);
    }
}
