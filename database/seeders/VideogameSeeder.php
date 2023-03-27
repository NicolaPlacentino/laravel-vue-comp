<?php

namespace Database\Seeders;

use App\Models\Videogame;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class VideogameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $videogame = new Videogame();
            $videogame->title = $faker->words(3, true);
            $videogame->platform = $faker->word();
            $videogame->publisher = $faker->word();
            $videogame->genre = $faker->word();
            // $videogame->image_url = $faker->imageUrl(250, 250);
            $videogame->description = $faker->paragraphs(5, true);
            $videogame->release_date = $faker->date();
            $videogame->weight = $faker->randomNumber(3, false);
            $videogame->save();
        }
    }
}
