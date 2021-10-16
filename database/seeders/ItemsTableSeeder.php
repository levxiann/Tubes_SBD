<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Faker\Factory;

class ItemsTableSeeder extends Seeder
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
            $items[] = [
                'title' => $faker->realText(10, 5),
                'date' => $faker->year(),
                'author' => $faker->name(),
                'type' => $faker->sentence(),
                'dimension' => $faker->sentence(),
                'repository' => $faker->realText(10, 5),
                'image' => $image,
                'created_at' => $date,
                'updated_at' => $date,
            ];

        }
        \DB::table('items')->insert($items);
    }
}
