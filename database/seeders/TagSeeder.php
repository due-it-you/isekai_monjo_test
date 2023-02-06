<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([

            'tag_label' => 'Vtuber'
        ]);

        Tag::create([
          
            'tag_label' => '歌い手'
        ]);

        Tag::create([
            
            'tag_label' => 'アニメ'
        ]);

        Tag::create([
            
            'tag_label' => 'マンガ'
        ]);



    }
}
