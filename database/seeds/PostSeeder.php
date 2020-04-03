<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,200) as $i){
            \App\Models\Post::create([
                'name' => $faker->realText('50'),
                'details' => $faker->realText('400'),
                'user_id' => $faker->numberBetween(1,20),
                'category_id' => $faker->numberBetween(1,5)
            ]);
        }
    }
}
