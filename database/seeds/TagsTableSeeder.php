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
            'content' => '香りが良い', 
        ]);
    }
}
