<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Factory::create();

        // Membangkitkan data dummy di table mediums
        for($i = 1; $i <= 20; $i++)
        {
            $date = date("Y-m-d H:i:s", strtotime("2021-10-15 11:00:00 + {$i} days"));
            $image = "nophoto.jpg";
            $articles[] = [
                'title' => $faker->realText(10),
                'content' => $faker->realText(),
                'credit' => $faker->realtext(10, 3),
                'writer' => $faker->name(),
                'image' => $image,
                'created_at' => $date,
                'updated_at' => $date,
            ];

        }
        \DB::table('articles')->insert($articles);
    }
}
