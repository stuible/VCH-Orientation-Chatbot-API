<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $intents = DB::table('intents')->get();

        $faker = \Faker\Factory::create();
        

        foreach ($intents as $intent) {
            DB::table('slots')->insert([
                'intentID' => $intent->id,
                'title' => 'One',
                'response' => $faker->realText($maxNbChars = 75, $indexSize = 2)
            ]);
            DB::table('slots')->insert([
                'intentID' => $intent->id,
                'title' => 'Two',
                'response' => $faker->realText($maxNbChars = 75, $indexSize = 2)
            ]);
            DB::table('slots')->insert([
                'intentID' => $intent->id,
                'title' => 'Three',
                'response' => $faker->realText($maxNbChars = 75, $indexSize = 2)
            ]);
            DB::table('slots')->insert([
                'intentID' => $intent->id,
                'title' => 'Four',
                'response' => $faker->realText($maxNbChars = 75, $indexSize = 2)
            ]);
            DB::table('slots')->insert([
                'intentID' => $intent->id,
                'title' => 'Five',
                'response' => $faker->realText($maxNbChars = 75, $indexSize = 2)
            ]);
        }
    }
}
