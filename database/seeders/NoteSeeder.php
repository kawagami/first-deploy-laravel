<?php

namespace Database\Seeders;

use App\Models\Note;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'catetory' => 'docker',
                'title'    => 'Docker 學習紀錄',
                'url'      => 'https://hackmd.io/@kawagami/Hk_ZzngGF',
            ],
            [
                'catetory' => 'deploy',
                'title'    => 'Deploy first laravel 站建置紀錄',
                'url'      => 'https://hackmd.io/@kawagami/rkwuOKc2j',
            ],
            [
                'catetory' => 'rust',
                'title'    => 'Rust 學習紀錄',
                'url'      => 'https://hackmd.io/@kawagami/rJg78Npto',
            ],
            [
                'catetory' => 'linux',
                'title'    => 'Linux 學習紀錄',
                'url'      => 'https://hackmd.io/@kawagami/S1vEGDtLq',
            ],
            [
                'catetory' => 'laravel',
                'title'    => 'Laravel 學習紀錄',
                'url'      => 'https://hackmd.io/@kawagami/HJeKAYGlt',
            ],
        ];
        foreach ($data as $d) {
            Note::create($d);
        }
    }
}
