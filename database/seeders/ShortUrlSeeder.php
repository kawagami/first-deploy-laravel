<?php

namespace Database\Seeders;

use App\Models\ShortUrl;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShortUrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShortUrl::create([
            "destination" => "https://translate.google.com.tw/?sl=en&tl=zh-TW&op=translate",
            "short_url"   => "fortest",
        ]);
    }
}
