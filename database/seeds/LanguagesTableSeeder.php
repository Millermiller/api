<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            'name' => 'is',
            'label' => 'Исландский',
            'flag' => '/img/is_round.png'
        ]);

        DB::table('languages')->insert([
            'name' => 'sw',
            'label' => 'Шведский',
            'flag' => '/img/sw_round.png'
        ]);
    }
}