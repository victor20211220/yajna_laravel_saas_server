<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Utility;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (!file_exists(storage_path() . "/installed")) {
            $this->call(UsersTableSeeder::class);
            $this->call(PlansTableSeeder::class);
            $this->call(AiTemplateSeeder::class);
            $this->call(NFCDataSeeder::class);
            $this->call(CategoryTableSeeder::class);

        } else {
            Utility::languagecreate();
        }
        Artisan::call('module:migrate LandingPage');
        Artisan::call('module:seed LandingPage');

    }
}
