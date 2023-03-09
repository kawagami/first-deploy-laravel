<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        $data = [
            [
                'name'            => '中文',
                'english_name'    => 'Chinese (Traditional)',
                'code'            => 'zh-TW',
                'origin_language' => '中文',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'name'            => '日本語',
                'english_name'    => 'Japanese',
                'code'            => 'ja',
                'origin_language' => '日本語',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'name'            => '英文',
                'english_name'    => 'English',
                'code'            => 'en',
                'origin_language' => 'English',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'name'            => '西班牙文',
                'english_name'    => 'Spanish',
                'code'            => 'es',
                'origin_language' => 'español',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'name'            => '韓文',
                'english_name'    => 'Korean',
                'code'            => 'ko',
                'origin_language' => '한국인',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'name'            => '越南文',
                'english_name'    => 'Vietnamese',
                'code'            => 'vi',
                'origin_language' => 'Tiếng Việt',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'name'            => '簡體中文',
                'english_name'    => 'Chinese (Simplified)',
                'code'            => 'zh-CN',
                'origin_language' => '简体中文',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'name'            => '阿拉伯文',
                'english_name'    => 'Arabic',
                'code'            => 'ar',
                'origin_language' => 'عربي',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'name'            => '菲律賓（他加祿語）',
                'english_name'    => 'Filipino (Tagalog)',
                'code'            => 'fil',
                'origin_language' => 'Pilipinas',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'name'            => '法文',
                'english_name'    => 'French',
                'code'            => 'fr',
                'origin_language' => 'Français',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'name'            => '德文',
                'english_name'    => 'German',
                'code'            => 'de',
                'origin_language' => 'Deutsch',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'name'            => '義大利文',
                'english_name'    => 'Italian',
                'code'            => 'it',
                'origin_language' => 'Italiano',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'name'            => '拉丁文',
                'english_name'    => 'Latin',
                'code'            => 'la',
                'origin_language' => 'Latine',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'name'            => '馬來文',
                'english_name'    => 'Malay',
                'code'            => 'ms',
                'origin_language' => 'Melayu',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'name'            => '葡萄牙文',
                'english_name'    => 'Portuguese',
                'code'            => 'pt',
                'origin_language' => 'Português',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'name'            => '俄文',
                'english_name'    => 'Russian',
                'code'            => 'ru',
                'origin_language' => 'Русский',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'name'            => '瑞典文',
                'english_name'    => 'Swedish',
                'code'            => 'sv',
                'origin_language' => 'svenska',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'name'            => '泰文',
                'english_name'    => 'Thai',
                'code'            => 'th',
                'origin_language' => 'แบบไทย',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'name'            => '土耳其文',
                'english_name'    => 'Turkish',
                'code'            => 'tr',
                'origin_language' => 'Türkçe',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'name'            => '烏克蘭文',
                'english_name'    => 'Ukrainian',
                'code'            => 'uk',
                'origin_language' => 'Україна',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
        ];

        Language::insert($data);
    }
}
