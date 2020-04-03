<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,20) as $i){
            \App\User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => \Illuminate\Support\Facades\Hash::make("demo"),
            ]);
        }
    }
}
