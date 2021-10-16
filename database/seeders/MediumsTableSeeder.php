<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Faker\Factory;

class MediumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        // Membangkitkan data dummy di table mediums
        for($i = 1; $i <= 20; $i++)
        {
            if($i % 5 == 1) {
                $image = "1_paper.jpg";
            } elseif($i % 5 == 2) {
                $image = "2_plastik.jpg";
            } elseif($i % 5 == 3)
            {
                $image = "3_tinta.jpg";
            } elseif($i % 5 == 4) {
                $image = "4_pena.jpg";
            } elseif($i % 5 == 0) {
                $image = "5_kapur.png";
            }

            $date = date("Y-m-d H:i:s", strtotime("2021-10-15 11:00:00 + {$i} days"));

            $mediums[] = [
                'name' => $faker->word(),
                'desc' => $faker->sentence(),
                'image' => $image,
                'created_at' => $date,
                'updated_at' => $date,
            ];

        }
        \DB::table('mediums')->insert($mediums);

    }
}
