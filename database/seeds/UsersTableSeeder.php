<?php

use Illuminate\Database\Seeder;
use Scandinaver\Learn\Infrastructure\Persistence\Eloquent\Asset;
use Scandinaver\User\Infrastructure\Persistence\Eloquent\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 5)->create()->each(function($user) {
            /*** @var User $user*/
            $user->assets()->saveMany(factory(Asset::class, 4)->make());

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