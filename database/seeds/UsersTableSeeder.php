<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 5)->create()->each(function($user) {
            /*** @var \App\User $user*/
            $user->assets()->saveMany(factory(App\Models\Asset::class, 4)->make());

            $favoriteId = DB::table('assets')->insertGetId([
                                           'title' => 'Избранное',
                                           'basic' => 0,
                                           'type' => 0,
                                           'level' => 0,
                                           'favorite' => 1,
                                           'language_id' => 1,
                                       ]);

            DB::table('assets_users')->insert([
                                                 'asset_id' => $favoriteId,
                                                 'user_id' => $user->id,
                                                 'result' => 0,
                                                 'language_id' => 1
                                             ]);

        });
    }
}