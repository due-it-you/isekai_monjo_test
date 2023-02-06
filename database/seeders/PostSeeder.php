<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'user_id' => '1',
            'title' => 'かなかな',
            'content' => 'Vtuberの男の子です。',
        ]);

        Post::create([
            'user_id' => '1',
            'title' => '剣持とうや',
            'content' => 'Vtuberのにじさんじ所属の男です。',
        ]);

        Post::create([
            'user_id' => '1',
            'title' => 'なぎさっち',
            'content' => 'lol界隈のアイドルです。',
        ]);

        Post::create([
            'user_id' => '1',
            'title' => 'スタンミ',
            'content' => 'lol界隈のイケメンです。',
        ]);
    }
}
