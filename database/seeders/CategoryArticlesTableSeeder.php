<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;

class CategoryArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $faker = Factory::create();
        
        for($i = 1; $i <= 10; $i++)
        {
            $date = date("Y-m-d H:i:s", strtotime("2021-10-15 11:00:00 + {$i} days"));
            $category_articles[] = [
                'article_id' => rand(1,20),
                'medium_id' => rand(1,20),
                'created_at' => $date,
                'updated_at' => $date,
            ];
        }
        \DB::table('category_articles')->insert($category_articles);
    }
}
