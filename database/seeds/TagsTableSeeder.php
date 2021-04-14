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
            'content' => '香りが良い', 
        ]);
    }
}
