<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FestivalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('festivals')->insert([
                'name' => $faker->words(2, true) . ' Festival',
                'date' => $faker->date(),
                'status' => $faker->randomElement(['Active', 'Inactive']),
                'email_scheduled' => $faker->randomElement(['Yes', 'No']),
                'subject_line' => $faker->sentence(),
                'email_body' => $faker->paragraph(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

