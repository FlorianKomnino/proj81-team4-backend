<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Visualization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class VisualizationSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 2500; $i++) {
            $newVisualization = new Visualization();
            $newVisualization->apartment_id = Apartment::inRandomOrder()->first()->id;
            $newVisualization->user_ip = $faker->numberBetween(1, 255) . '.' . $faker->numberBetween(1, 255) . '.' . $faker->numberBetween(1, 255) . '.' . $faker->numberBetween(1, 255);
            $newVisualization->save();
            $newVisualization->created_at = $faker->dateTimeBetween('-1 year', '-1 day');
            $newVisualization->update();
        }
    }
}
