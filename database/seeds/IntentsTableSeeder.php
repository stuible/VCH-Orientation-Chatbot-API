<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IntentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('intents')->insert([
            'name' => 'Policies',
            'description' => 'Repsonse for policies',
        ]);
        DB::table('intents')->insert([
            'name' => 'Forms',
            'description' => 'Repsonse for forms',
        ]);
        DB::table('intents')->insert([
            'name' => 'Courses',
            'description' => 'Repsonse for courses',
        ]);
        DB::table('intents')->insert([
            'name' => 'In Person',
            'description' => 'Repsonse for in person orientation stuff',
        ]);
        DB::table('intents')->insert([
            'name' => 'Definitions',
            'description' => 'Repsonse for definitions and acronyms',
        ]);
    }
}
