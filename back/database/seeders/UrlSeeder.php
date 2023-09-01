<?php

namespace Database\Seeders;

use App\Models\Url;
use Illuminate\Database\Seeder;

class UrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Url::factory(5)->create()->each(function (Url $url) {
            //Special treatment goes here.
        });
    }
}
