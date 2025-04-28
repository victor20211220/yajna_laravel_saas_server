<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateThemesAndEnableGptOnPlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plans')->update([
            'themes' => 'theme1',
            'enable_chatgpt' => 'off',
        ]);
    }
}
