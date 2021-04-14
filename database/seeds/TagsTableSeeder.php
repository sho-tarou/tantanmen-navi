<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        DB::table('tags')->where('content', '香りが良い')->delete();
        
        DB::table('tags')->insert([
            'content' => '激辛', 
        ]);
        DB::table('tags')->insert([
            'content' => '辛い'
        ]);
        DB::table('tags')->insert([
            'content' => '辛さ控え目'
        ]);
        DB::table('tags')->insert([
            'content' => '痺れる'
        ]);
        DB::table('tags')->insert([
            'content' => '酸味あり'
        ]);
        DB::table('tags')->insert([
            'content' => 'スパイシー'
        ]);
        DB::table('tags')->insert([
            'content' => 'クリーミー'
        ]);
        DB::table('tags')->insert([
            'content' => '濃厚'
        ]);
        DB::table('tags')->insert([
            'content' => 'さっぱり'
        ]);
        DB::table('tags')->insert([
            'content' => '細麺'
        ]);
        DB::table('tags')->insert([
            'content' => '中太麺'
        ]);
        DB::table('tags')->insert([
            'content' => '太麺'
        ]);
        DB::table('tags')->insert([
            'content' => '縮れ麺'
        ]);
        DB::table('tags')->insert([
            'content' => '黒胡麻'
        ]);
        DB::table('tags')->insert([
            'content' => '白胡麻'
        ]);
        DB::table('tags')->insert([
            'content' => '汁なし'
        ]);
        DB::table('tags')->insert([
            'content' => '冷やし'
        ]);
        DB::table('tags')->insert([
=======
        DB::table('tags')->insert([
            'content' => '激辛', 
            'content' => '辛い', 
            'content' => '辛さ控え目', 
            'content' => '痺れる', 
            'content' => '酸味あり', 
            'content' => 'スパイシー', 
            'content' => 'クリーミー', 
            'content' => '濃厚', 
            'content' => 'さっぱり', 
            'content' => '細麺', 
            'content' => '中太麺', 
            'content' => '太麺', 
            'content' => '縮れ麺', 
            'content' => '黒胡麻', 
            'content' => '白胡麻', 
            'content' => '汁なし', 
            'content' => '冷やし', 
>>>>>>> 7882c26a232ab0a623fada0d6decc5b6899dd77b
            'content' => '香りが良い', 
        ]);
    }
}
