<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,5) as $i){
            \App\Models\Category::create([
                'name' => $faker->word,
            ]);
        }
    }
}
